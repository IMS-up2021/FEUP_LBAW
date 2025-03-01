@extends('layouts.app')

<script>
document.addEventListener('DOMContentLoaded', function () {
    var answerForm = document.getElementById('answerForm');

    answerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(answerForm);

        // Make an AJAX request
        fetch('{{ route("createAnswer", ["id" => $question->question_id]) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                var answersContainer = document.getElementById('answersContainer');

                // Create container div for the answer
                var answerContainer = document.createElement('div');
                answerContainer.innerHTML = '<li>' + data.content + '</li><p>Answered by: ' + data.user.username + 
                '<p>Status: <th>' + (data.is_correct ? 'Correct' : 'None') + '</th></p><p>Date: ' + data.date + '</p>';

                // Create form for deleting the answer
                var deleteForm = document.createElement('form');
                deleteForm.action = '{{ route('deleteAnswer', ['id' => $question->question_id]) }}';
                deleteForm.method = 'POST';

                // Add CSRF token input
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                deleteForm.appendChild(csrfInput);

                // Add method override input
                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                deleteForm.appendChild(methodInput);

                // Add answer ID input
                var answerIdInput = document.createElement('input');
                answerIdInput.type = 'hidden';
                answerIdInput.name = 'answer_id';
                answerIdInput.value = data.answer_id; 
                deleteForm.appendChild(answerIdInput);

                // Add delete button
                var deleteButton = document.createElement('button');
                deleteButton.type = 'submit';
                deleteButton.textContent = 'Delete Answer';
                deleteButton.addEventListener('click', function () {
                    return confirm('Are you sure you want to delete this answer?');
                });

                deleteForm.appendChild(deleteButton);
                answerContainer.appendChild(deleteForm);

                // Create form for editing the answer
                var editForm = document.createElement('form');
                editForm.action = '{{ route('showEditAnswerForm', ['id' => $question->question_id, 'answer_id' => 'REPLACE_WITH_ANSWER_ID']) }}'.replace('REPLACE_WITH_ANSWER_ID', data.answer_id);
                editForm.method = 'GET';

                // Add edit button
                var editButton = document.createElement('button');
                editButton.type = 'submit';
                editButton.textContent = 'Edit Answer';

                editForm.appendChild(editButton);
                answerContainer.appendChild(editForm);

                // Add mark as correct form and View Comments link
                if (data.question_user === {{ Auth::id() }}) {
                    var markAsCorrectForm = document.createElement('form');
                    markAsCorrectForm.action = '{{ route('markAsCorrect', ['id' => 'REPLACE_WITH_ANSWER_ID']) }}'.replace('REPLACE_WITH_ANSWER_ID', data.answer_id);
                    markAsCorrectForm.method = 'POST';

                    // Add CSRF token input for mark as correct form
                    var markAsCorrectCsrfInput = document.createElement('input');
                    markAsCorrectCsrfInput.type = 'hidden';
                    markAsCorrectCsrfInput.name = '_token';
                    markAsCorrectCsrfInput.value = '{{ csrf_token() }}';
                    markAsCorrectForm.appendChild(markAsCorrectCsrfInput);

                    // Add hidden input for mark as correct
                    var markAsCorrectInput = document.createElement('input');
                    markAsCorrectInput.type = 'hidden';
                    markAsCorrectInput.name = 'correct';
                    markAsCorrectInput.value = data.is_correct ? 0 : 1;
                    markAsCorrectForm.appendChild(markAsCorrectInput);

                    // Add mark as correct button
                    var markAsCorrectButton = document.createElement('button');
                    markAsCorrectButton.type = 'submit';
                    markAsCorrectButton.textContent = data.is_correct ? 'Remove Correct' : 'Mark as Correct';

                    markAsCorrectForm.appendChild(markAsCorrectButton);
                    answerContainer.appendChild(markAsCorrectForm);
                }

                var viewCommentsLink = document.createElement('a');
                viewCommentsLink.className = 'button';
                viewCommentsLink.href = '/question/' + data.question_id + '/answer/' + data.answer_id + '/comments';
                viewCommentsLink.textContent = 'View Comments';

                answerContainer.appendChild(viewCommentsLink);

                answersContainer.appendChild(answerContainer);

                answerForm.reset();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
</script>
@section('content')

@php
    $user_question = \App\Models\User::find($question->questionOrAnswer->publication->user_id);
@endphp

<div>
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->questionOrAnswer->publication->content }}</p>
    <p>Tag: {{ optional($question->questionOrAnswer->publication->tag)->tag_name ?? 'Deleted Tag' }}</p>
    <p>Score: {{ $question->questionOrAnswer->score }}</p>
    <p>Status: {{ $question->status }}</p>
    <p>Posted on: {{ $question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>
    <p>Created by : {{ optional($user_question)->username ?? 'Deleted User' }}</p>


    @if($review == null)
        <form method="POST" action="{{ route('createQuestionReview', ['id' => $question->question_id]) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">
            <input type="hidden" name="positive" value="1">
            <button type="submit">Upvote</button>
        </form>
        <form method="POST" action="{{ route('createQuestionReview', ['id' => $question->question_id]) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">
            <input type="hidden" name="positive" value="0">
            <button type="submit">Downvote</button>
        </form>
    @elseif($review->positive)
        <form method="POST" action="{{ route('changeQuestionReview', ['id' => $question->question_id]) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">
            <input type="hidden" name="positive" value="0">
            <button type="submit">Downvote</button>
        </form>
    @else
        <form method="POST" action="{{ route('changeQuestionReview', ['id' => $question->question_id]) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">
            <input type="hidden" name="positive" value="1">
            <button type="submit">Upvote</button>
        </form>
    @endif





    @if(Auth::check() && $question->questionOrAnswer->publication->user_id === Auth::id())
    <form method="GET" action="{{ url('/question/' . $question->question_id . '/edit') }}">
        <input type="hidden" name="id" value="{{ $question->question_id }}">
        <button type="submit">Edit Question</button>
    </form>   
    
    <form method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Question</button>
    </form>
    @endif
    <a class='button' href='/question/{{$question->question_id}}/comments'>View Question Comments</a>
</div>

<hr>

<div id="answersContainer">
    <h2>Answers</h2>
    @foreach ($answers as $answer)
        @php
            $user_answer = \App\Models\User::find($answer->questionOrAnswer->publication->user_id);
        @endphp
        <div>
            <li>{{ $answer->questionOrAnswer->publication->content}}</li>   
            <p>Answered by: {{ optional($user_answer)->username ?? 'Deleted User' }}</p>
            <p>Status: <th>{{ $answer->is_correct == 1 ? 'Correct' : 'None' }}</th></p>
            <p>Date: {{ $answer->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>        
        </div>
        @if(Auth::check() && $answer->questionOrAnswer->publication->user_id === Auth::id())
        <form action="{{ route('deleteAnswer', ['id' => $question->question_id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="answer_id" value="{{ $answer->answer_id }}">
            <button type="submit">Delete Answer</button>
        </form>
        <form method="GET" action="{{ route('showEditAnswerForm', ['id' => $question->question_id, 'answer_id' => $answer->answer_id]) }}">
            <input type="hidden" name="answer_id" value="{{ $answer->answer_id }}">
            <button type="submit">Edit Answer</button>
        </form>   
        @endif
        @if (Auth::check() && $question->questionOrAnswer->publication->user_id === Auth::id())
        <form method="POST" action="{{ route('markAsCorrect', ['id' => $answer->answer_id]) }}" id="mark-as-correct-form">
            @csrf
            <input type="hidden" name="correct" value="{{ $answer->is_correct ? 0 : 1 }}">
            <button type="submit">{{ $answer->is_correct ? 'Remove Correct' : 'Mark as Correct' }}</button>
        </form>
        @endif
        <a class='button' href='/question/{{$question->question_id}}/answer/{{$answer->answer_id}}/comments'>View Comments</a>
        @endforeach
</div>

<hr>

<div>
    <h2>Your Answer</h2>
    <form id="answerForm" method="POST">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->question_id }}">
        <input type="hidden" name="tag_id" value="{{ $question->questionOrAnswer->publication->tag_id }}">
        <input type="hidden" name="date" value="{{ now() }}">

        <label for="content">Your Answer:</label>
        <textarea id="content" name="content" required>{{ old('content') }}</textarea>

        <button type="submit">Submit Answer</button>
    </form>
</div>

@endsection

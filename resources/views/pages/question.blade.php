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
            answersContainer.innerHTML += '<div><li>' + data.content + '</li><p>Answered by: ' + data.user.username + '</p><p>Date: ' + data.date + '</p></div>';

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
    <p>Tag: {{ $question->questionOrAnswer->publication->tag->tag_name }}</p>
    <p>Score: {{ $question->questionOrAnswer->score }}</p>
    <p>Status: {{ $question->status }}</p>
    <p>Posted on: {{ $question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>
    <p>Created by: {{ $user_question->username }}</p>
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
            <p>Answered by: {{ $user_answer->username }}</p>
            <p>Date: {{ $answer->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>        
        </div>
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

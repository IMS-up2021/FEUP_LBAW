@extends('layouts.app')

@section('content')

    <h2>Comments of question "{{$question->title}}"</h2>
    @foreach ($comments as $comment)
        @php
            $user_comment = \App\Models\User::find($comment->publication->user_id);
        @endphp
        <div>
            <p>{{ $comment->publication->content }}</p>
            <p>Commented on: {{ $comment->publication->date->format('Y-m-d H:i:s') }}</p>
            <p>Commented by: {{ $user_comment ? $user_comment->username : 'Deleted User' }}</p>
        </div>
        @if(Auth::check() && $user_comment && $user_comment->id === Auth::id())
        <form method="GET" action="{{ route('showQuestionCommentForm', ['id' => $question->question_id, 'comment_id' => $comment->comment_id]) }}">
            <button type="submit">Edit Comment</button>
        </form>   
        <form action="{{ route('deleteQuestionComment',['id' => $question->question_id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">
            <button type="submit">Delete Comment</button>
        </form>
 
        @endif
        <hr>
    @endforeach

    <div>
    <h2>Your Comment</h2>
    <form id="commentForm" method="POST">
        @csrf
        <input type="hidden" name="question_id" value="{{ $question->question_id }}">
        <input type="hidden" name="tag_id" value="{{ $question->questionOrAnswer->publication->tag_id }}">
        <input type="hidden" name="date" value="{{ now() }}">

        <label for="content">Your Comment:</label>
        <textarea id="content" name="content" required>{{ old('content') }}</textarea>

        <button type="submit">Submit Comment</button>
    </form>
</div>

@endsection


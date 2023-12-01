@extends('layouts.app')

@section('content')

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        @php
            $user_question = \App\Models\User::find($comment->publication->user_id);
        @endphp
        <div>
            <p>{{ $comment->publication->content }}</p>
            <p>Commented on: {{ $comment->publication->date->format('Y-m-d H:i:s') }}</p>
            <p>Commented by: {{ $user_question->username }}</p>
            <hr>
    @endforeach

    <div>
    <h2>Your Comment</h2>
    <form id="answerForm" method="POST">
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


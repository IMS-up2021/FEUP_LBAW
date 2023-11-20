@extends('layouts.app')

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

<div>
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
    <form method="POST" action="/question/{{$question->question_id}}">
    @csrf
    <input type="hidden" name="question_id" value="{{ $question->question_id }}">
    <input type="hidden" name="tag_id" value="{{ $question->questionOrAnswer->publication->tag_id }}">

    <label for="content">Your Answer:</label>
    <textarea id="content" name="content" required>{{ old('content') }}</textarea>

    <button type="submit">Submit Answer</button>
</form>
</div>

@endsection

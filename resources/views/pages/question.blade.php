@extends('layouts.app')

@section('content')

@php
    $user = \App\Models\User::find($question->questionOrAnswer->publication->user_id);
@endphp

<div>
    <h1>{{ $question->title }}</h1>
    <p>{{ $question->questionOrAnswer->publication->content }}</p>
    <p>Tag: {{ $question->questionOrAnswer->publication->tag->tag_name }}</p>
    <p>Score: {{ $question->questionOrAnswer->score }}</p>
    <p>Status: {{ $question->status }}</p>
    <p>Posted on: {{ $question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>
    <p>Created by: {{ $user->username }}</p>
</div>

<hr>

<div>
    <h2>Answers</h2>
</div>

<hr>


@endsection

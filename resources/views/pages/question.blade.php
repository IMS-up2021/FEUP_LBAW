@extends('layouts.app')

@section('content')

<h1>Content</h1>
<p>{{ $question->questionOrAnswer->publication->content }}</p>
<p>{{ $question->questionOrAnswer->publication->tag->tagname }}</p>
<p>{{ $question->questionOrAnswer->publication->date }}</p>

@endsection
@extends('layouts.app')

@section('content')

<h1>Content</h1>
<p>{{ $question->questionOrAnswer->publication->content }}</p>
<p>{{ $question->questionOrAnswer->publication->tag->tagname }}</p>
<p>{{ $question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</p>

@endsection
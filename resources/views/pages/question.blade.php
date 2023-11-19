@extends('layouts.app')

@section('content')

<h1>Content</h1>
<p>{{ $question->questionOrAnswer->publication->content }}</p>

@endsection
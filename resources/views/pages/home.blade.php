@extends('layouts.app')

@section('content')

@foreach ($questions as $question)

<a class='button' href='/question/{{$question->question_id}}'>{{ $question->title }} {{ $question->question_id}}</a> 

@endforeach

@endsection
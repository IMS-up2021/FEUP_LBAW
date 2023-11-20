@extends('layouts.app')

@section('content')

<h1>View my questions:</h1>
@foreach ($questions as $question)
<div>
<a class='button' href='/question/{{$question->question_id}}'>{{ $question->title }}</a> 
</div>
@endforeach

<h1>View my answers:</h1>
@foreach ($answers as $answer)
<div>
<a class='button' href='/question/{{$answer->question_id}}'>{{ $answer->questionOrAnswer->publication->content }}</a>
</div>  
@endforeach

@endsection

@extends('layouts.app')

@section('content')

<a class="button" href="{{ url('/question') }}"> Create Question </a>
@foreach ($questions as $question)
<div>
<a class='button' href='/question/{{$question->question_id}}'>{{ $question->title }}</a> 
</div>
@endforeach

@endsection
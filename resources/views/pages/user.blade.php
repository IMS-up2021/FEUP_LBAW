@extends('layouts.app')

@section('content')

<div>
    <h1>{{$user->username}}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Username: {{ $user->username }}</p>
    <p>Description: {{ $user->description ?? 'No description available' }}</p>
    
</div>

@if (Auth::check() && $user->id === Auth::id())
<div>
    <a class="button" href="{{ route('editProfileForm', ['id' => $user->id]) }}">Edit Profile</a>
</div>
@endif

<hr>

<h2>My Questions:</h2>
@foreach ($questions as $question)
    <div>
        <a class='button' href='/question/{{$question->question_id}}'>{{ $question->title }}</a> 
    </div>
@endforeach

<hr>

<h2>My Answers:</h2>
@foreach ($answers as $answer)
    <div>
        <a class='button' href='/question/{{$answer->question_id}}'>{{ $answer->questionOrAnswer->publication->content }}</a>
    </div>  
@endforeach

@endsection

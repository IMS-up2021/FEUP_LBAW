@extends('layouts.app')

@section('content')

<a class="button" href="{{ url('/question') }}"> Create Question </a>

<form method="GET" action="{{ route('search') }}">
    <label for="search">Search Questions:</label>
    <input type="text" id="search" name="search" placeholder="Search a question">
    <button type="submit">Search</button>
</form>

<h2>Top Questions</h2>
<table class="top_questions">
    <thead>
        <tr>
            <th>Author</th>
            <th colspan = "4">Question</th>
            <th>Status</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($top_questions as $top_question)
            <tr>
                @php
                    $user_question = \App\Models\User::find($top_question->questionOrAnswer->publication->user_id);
                @endphp
                <th>
                @if ($user_question)
                    <a class='button' href="{{ url('/user/' . $user_question->id) }}">{{ $user_question->username }}</a>
                @else
                    Deleted User
                @endif
                </th>
                <th colspan = "4">
                    <a class='button' href='/question/{{$top_question->question_id}}'>{{ $top_question->title }}</a>
                </th>
                <th>{{ $top_question->status }}</th>
                <th>{{ $top_question->questionOrAnswer->score }}</th>
                <th>{{ $top_question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Recent Questions</h2>
<table class = "recent_questions">
    <thead>
        <tr>
            <th>Author</th>
            <th colspan = "4">Question</th>
            <th>Status</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recentQuestions as $recentQuestion)
            <tr>
                @php
                    $user_question = \App\Models\User::find($recentQuestion->questionOrAnswer->publication->user_id);
                @endphp
                <th>
                @if ($user_question)
                    <a class='button' href="{{ url('/user/' . $user_question->id) }}">{{ $user_question->username }}</a>
                @else
                    Deleted User
                @endif
                </th>
                <td colspan = "4">
                    <a class = 'button' href = '/question/{{$recentQuestion->question_id}}'>{{ $recentQuestion->title }}</a>
                </td>
                <th>{{ $recentQuestion->status }}</th>
                <th>{{ $recentQuestion->questionOrAnswer->score }}</th>
                <th>{{ $recentQuestion->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Questions</h2>
<table class = "questions">
    <thead>
        <tr>
            <th>Author</th>
            <th colspan = "4">Question</th>
            <th>Status</th>
            <th>Score</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($questions as $question)
            <tr>
                @php
                    $user_question = \App\Models\User::find($question->questionOrAnswer->publication->user_id);
                @endphp
                <th>
                @if ($user_question)
                    <a class='button' href="{{ url('/user/' . $user_question->id) }}">{{ $user_question->username }}</a>
                @else
                    Deleted User
                @endif
                </th>
                <th colspan = "4">
                    <a class='button' href='/question/{{$question->question_id}}'>{{ $question->title }}</a> 
                </th>
                <th>{{ $question->status }}</th>
                <th>{{ $question->questionOrAnswer->score }}</th>
                <th>{{ $question->questionOrAnswer->publication->date->format('Y-m-d H:i:s') }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
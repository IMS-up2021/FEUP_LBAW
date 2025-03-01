@extends('layouts.app')

@section('content')

<a class="button" href="{{ url('/question') }}"> Create Question </a>

<h2>Search Results</h2>
    <table class="search-results">
        <thead>
            <tr>
                <th>Author</th>
                <th colspan="4">Question</th>
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
                    @if ($user_question)
                    <th>{{ $user_question->username }}</th>
                    @else
                    <th>Deleted User</th>
                    @endif
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

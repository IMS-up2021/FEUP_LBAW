@extends('layouts.app')

@section('content')

<h2>Search for a user</h2>

<form method="GET" action="{{ route('searchUser') }}">
    <label for="search">Search Users:</label>
    <input type="text" id="search" name="search" placeholder="Search the username">
    <button type="submit">Search</button>
</form>

<table class="search-results">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th>
                    <a class='button' href="{{ url('/user/' . $user->id) }}">{{ $user->username }}</a>
                </th>
                <th>{{ $user->email }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
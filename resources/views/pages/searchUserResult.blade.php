@extends('layouts.app')

@section('content')

<h2>Search User Results</h2>
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

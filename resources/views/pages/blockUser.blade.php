@extends('layouts.app')

@section('content')

<h2>Block Users</h2>

<table class="search-results">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Blocked</th>
            <th>Block/Unblock</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th>
                    <a class='button' href="{{ url('/user/' . $user->id) }}">{{ $user->username }}</a>
                </th>
                <th>{{ $user->email }}</th>
                <th>{{ $user->blocked == 1 ? 'Yes' : 'No' }}</th>
                <th>
                    <form method="POST" action="{{ route('blockUser', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="blocked" value="{{ $user->blocked == 1 ? 0 : 1 }}">
                        <button type="submit">{{ $user->blocked == 1 ? 'Unblock' : 'Block' }}</button>
                    </form>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
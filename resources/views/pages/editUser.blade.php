@extends('layouts.app')

@section('content')

<h1>Edit Users</h1>
@foreach ($users as $user)
    <div>
        <a class="button" href="{{ route('showEditUserForm', ['id' => $user->id]) }}">{{ $user->username }}</a>
    </div>
@endforeach
@endsection
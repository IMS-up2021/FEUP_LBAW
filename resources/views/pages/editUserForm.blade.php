@extends('layouts.app')

@section('content')

<h1>Edit User</h1>
<form method="POST" action="/administration/edit-user/{{$user->id}}">
    @csrf
    @method('PUT')
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{$user->username}}">
        <input type="hidden" name="id" id="id" value="{{$user->id}}">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{$user->email}}">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"z\>
    </div>
    <div>
        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="1">Administrator</option>
            <option value="2">Moderator</option>
            <option value="3">User</option>
        </select>
    </div>
    <div>
        <button type="submit">Edit User</button>
    </div>
    </form>
@endsection
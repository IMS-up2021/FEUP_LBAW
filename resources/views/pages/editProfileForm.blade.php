@extends('layouts.app')

@section('content')

<h1>Edit Profile</h1>
<form method="POST" action="{{ route('editProfile', ['id' => $user->id]) }}">
    @csrf
    @method('PUT')

    <label for="username">Username</label>
    <input id="username" type="text" name="username" value="{{$user->username}}" required autofocus>
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{$user->email}}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <label for="description">Description</label>
    <textarea id="description" name="description" required>{{$user->description}}</textarea>
    
    <div>
        <button type="submit">Save</button>
    </div>
    </form>
@endsection
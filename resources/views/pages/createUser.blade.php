@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('createUser') }}">
    {{ csrf_field() }}

    <label for="username">Username</label>
    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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

    <label for="role">Role</label>
    <select id="role" name="role">
        <option value="1">Administrator</option>
        <option value="2">Moderator</option>
        <option value="3">User</option>
    </select>

    <label for="description">Description</label>
    <textarea id="description" name="description" required>{{ old('description') }}</textarea>
    
    <button type="submit">
        Create User
    </button>
</form>
@endsection
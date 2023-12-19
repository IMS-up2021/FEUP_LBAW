@extends('layouts.app')

@section('content')

<h1>New Password</h1>

<form action="{{ route('createResetPassword', ['token' => $token]) }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password">New Password</label>
        <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Enter password confirmation">
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
</form>
@endsection

@extends('layouts.app')

@section('content')

<h1>Reset Password</h1>

<form action="" method="post">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
</form>
@endsection

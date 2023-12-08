@extends('layouts.app')

@section('content')

<h1>Delete User</h1>
@foreach ($users as $user)
    <form action="{{ route('deleteUser', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <label for="name">{{$user->username}}</label>
        </div>
        <button type="submit" class="btn btn-primary">Delete User</button>
    </form>
@endforeach
@endsection

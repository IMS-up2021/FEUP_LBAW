@extends('layouts.app')

@section('content')

<h1>Create Tag</h1>
<form method="POST" action="{{ route('createTag') }}">
    @csrf
    <!-- Tag Name -->
    <label for="tag_name">Tag Name:</label>
    <input type="text" id="tag_name" name="tag_name" value="{{ old('tag_name') }}" required>

    <button type="submit">Create Tag</button>
</form>
<h2>Existing Tags</h2>
@foreach ($tags as $tag)
    <p class="button">{{ $tag->tag_name }}</p>
@endforeach
@endsection
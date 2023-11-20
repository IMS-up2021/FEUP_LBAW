@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('createQuestion') }}">
    @csrf
    <!-- Question Title -->
    <label for="title">Question Title:</label>
    <input type="text" id="title" name="title" value="{{ old('title') }}" required>

    <!-- Question Description -->
    <label for="content">Content:</label>
    <textarea id="content" name="content" required>{{ old('content') }}</textarea>

    <!-- Question Tag -->
    <label for="tag_id">Tag:</label>
        <select id="tag_id" name="tag_id" required>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
                    {{ $tag->tagname }}
                </option>
            @endforeach
        </select>

    <!-- Question Date -->
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="{{ old('date') }}" required>

    <button type="submit">Create Question</button>
</form>
@endsection
@extends('layouts.app')

@section('content')

<h1>Edit Question</h1>

<form action="{{ route('updateQuestion', ['id' => $question->question_id]) }}" method="POST">
    @csrf
    @method('PUT') 
    <input type="hidden" name="id" value="{{ $question->question_id }}">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{ $question->title }}" required>

    <label for="content">Content:</label>
    <textarea id="content" name="content" required>{{ $question->questionOrAnswer->publication->content }}</textarea>

    <label for="tag_id">Tag:</label>
        <select id="tag_id" name="tag_id" required>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
                    {{ $tag->tag_name }}
                </option>
            @endforeach
        </select>

       <!-- Question Status -->
    <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
 
    <button type="submit">Update Question</button>
</form>

@endsection

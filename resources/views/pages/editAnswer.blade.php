@extends('layouts.app')

@section('content')

<h1>Edit Answer</h1>
<form id="editAnswerForm" action="{{ route('updateAnswer', ['id' => $question->question_id, 'answer_id' => $answer->answer_id]) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="content">Edit Answer:</label>
    <textarea id="content" name="content" required>{{ $answer->content }}</textarea>
    <button type="submit">Update Answer</button>
</form>

@endsection
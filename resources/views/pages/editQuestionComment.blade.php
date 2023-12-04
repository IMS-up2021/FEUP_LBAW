 @extends('layouts.app')

@section('content')

<h1>Edit Question Comment</h1>
<form id="editQuestionCommentForm" action="{{ route('updateQuestionComment', ['id' => $question->question_id, 'comment_id' => $comment->comment_id]) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="content">Edit Comment:</label>
    <textarea id="content" name="content" required>{{$comment->publication->content}}</textarea>
    <input type="hidden" name="question_id" value="{{ $question->question_id }}">
    <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
    <button type="submit">Update Comment</button>
</form>

@endsection
<form method="POST" action="{{ route('createQuestion') }}">
    @csrf
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="{{ old('title') }}" required>
<!--
    <label for="tag_id">Tag ID:</label>
    <input type="number" id="tag_id" name="tag_id" value="1" required>
-->

    <label for="content">Content:</label>
    <textarea id="content" name="content" required>{{ old('content') }}</textarea>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="{{ old('date') }}" required>

    <input type="submit" value='submit'>
</form>

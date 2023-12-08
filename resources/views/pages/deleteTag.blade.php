@extends('layouts.app')

@section('content')

<h1>Delete Tag</h1>
@foreach ($tags as $tag)
    <form action="{{ route('deleteTag', ['id' => $tag->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <label for="name">{{$tag->tag_name}}</label>
        </div>
        <button type="submit" class="btn btn-primary">Delete Tag</button>
    </form>
@endforeach
@endsection

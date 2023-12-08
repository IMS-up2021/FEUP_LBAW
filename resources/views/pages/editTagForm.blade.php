@extends('layouts.app')

@section('content')

<h1>Edit Tag</h1>
<form method="POST" action="/administration/edit-tag/{{$tag->id}}">
    @csrf
    @method('PUT')
    <div>
        <label for="tag_name">Tag Name</label>
        <input type="text" name="tag_name" id="tag_name" value="{{$tag->tag_name}}">
        <input type="hidden" name="id" id="id" value="{{$tag->id}}">
    </div>
    <div>
        <button type="submit">Edit Tag</button>
    </div>
@endsection
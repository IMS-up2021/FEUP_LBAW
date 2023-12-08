@extends('layouts.app')

@section('content')

<h1>Edit Tag</h1>
@foreach ($tags as $tag)
    <div>
        <a class="button" href="/administration/edit-tag/{{$tag->id}}">{{$tag->tag_name}}</a>
    </div> 
@endforeach
@endsection
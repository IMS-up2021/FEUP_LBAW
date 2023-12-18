@extends('layouts.app')

@section('content')

@if ($errors->has('email'))
    <span class="error">
        {!! $errors->first('email') !!}
    </span>
    @endif
<h2>Contact Support</h2>
<form action="{{ route('createAppeal') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
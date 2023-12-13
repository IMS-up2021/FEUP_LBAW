@extends('layouts.app')

@section('content')

<h1>Show Appeals</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Appeal ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Description</th>
            <th scope="col">Delete Appeal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appeals as $appeal)
        <tr>
            <th scope="row">{{$appeal->appeal_id}}</th>
            <td>{{$appeal->user->username}}</td>
            <td>{{$appeal->description}}</td>
            <td>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="appeal_id" value="{{$appeal->appeal_id}}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

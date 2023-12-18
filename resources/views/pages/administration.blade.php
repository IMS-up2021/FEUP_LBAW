@extends('layouts.app')

@section('content')

<h1>Administration</h1>

<h2>Manage Tags</h2>

<div>
    <a class="button" href="/administration/create-tag">Create a new tag</a>
    <a class="button" href="/administration/edit-tag">Edit an existing tag</a>
    <a class="button" href="/administration/delete-tag">Delete an existing tag</a>
</div>

<h2>Manage Users</h2>

<div>
    <a class="button" href="/administration/create-user">Create a new user</a>
    <a class="button" href="/administration/edit-user">Edit an existing user</a>
    <a class="button" href="/administration/delete-user">Delete an existing user</a>
    <a class="button" href="/administration/search-user">Search for a user</a>
    <a class="button" href="/administration/block-user">Block/Unblock a user</a>
    <a class="button" href="/administration/show-appeals">See appeals</a>
</div>

@endsection
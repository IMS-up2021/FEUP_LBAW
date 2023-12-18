@extends('layouts.app')

@section('content')

@if (Auth::user()->isAdmin())
<h1>Administration</h1>
@elseif (Auth::user()->isModerator())
<h1>Moderation</h1>
@endif

<h2>Manage Tags</h2>

<div>
    @if (Auth::user()->isAdmin())
    <a class="button" href="/administration/create-tag">Create a new tag</a>
    @endif
    <a class="button" href="/administration/edit-tag">Edit an existing tag</a>
    @if (Auth::user()->isAdmin())
    <a class="button" href="/administration/delete-tag">Delete an existing tag</a>
    @endif
</div>

<h2>Manage Users</h2>

<div>
    @if (Auth::user()->isAdmin())
    <a class="button" href="/administration/create-user">Create a new user</a>
    <a class="button" href="/administration/edit-user">Edit an existing user</a>
    <a class="button" href="/administration/delete-user">Delete an existing user</a>
    @endif
    <a class="button" href="/administration/search-user">Search for a user</a>
    <a class="button" href="/administration/block-user">Block/Unblock a user</a>
    <a class="button" href="/administration/show-appeals">See appeals</a>
</div>

@endsection
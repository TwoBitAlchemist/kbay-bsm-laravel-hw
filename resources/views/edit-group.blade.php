@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Group')
@section('content')
<a href="{{ url('groups') }}">&larr; Back to Groups</a>
<h2>Editing Group: {{ $group->name }}</h2>
<form method="post" id="edit-group-form"
      action="{{ url('edit-group') }}">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $group->id }}">
  <div class="form-group">
    <label for="name">Group Name: </label>
    <input type="text" name="name" id="group-name"
           class="form-control" value="{{ $group->name }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="description">Group Description: </label>
    <textarea class="form-control" name="description" rows="5"
              id="group-description">{{ $group->description }}</textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
  </div>{{-- .form-group --}}
</form>
<h2>Invite Others to Join This Group:</h2>
  <ul>
    @foreach ($users as $user)
      <li>{{ $user->name }}</li>
    @endforeach
  </ul>
@endsection

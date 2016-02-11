@extends('layouts.base', ['show_logo' => true])

@section('title', 'Groups')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
@if (count($groups) > 1)
  <p>You are a member of {{ count($groups) }} groups.</p>
  <ul class="row list-unstyled">
    @foreach ($groups as $group)
      <li class="col-sm-4">
      <dl>
        <dt><a href="/edit-group/{{ $group->id }}">{{ $group->name }}</a></dt>
        <dd>{{ $group->description }}</dd>
      </dl>
      </li>
    @endforeach
  </ul>
@elseif (count($groups) === 1)
  <p>You are a member of only 1 group:
  <a href="/edit-group/{{ $groups[0]->id }}">{{ $groups[0]->name }}</a>.</p>
@else
  <p>You are not in any groups yet.</p>
@endif
<p>If you want to have more fun, you should
<a href="{{ url('join-groups') }}">join more groups</a>!</p>

<hr>

<h2 class="h3">Form a New Group:</h2>
<form id="create-group-form" action="{{ url('groups') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">Group Name</label>
    <input type="text" name="name" id="group-name" class="form-control">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="description">Group Description</label>
    <textarea cols="80" rows="5" class="form-control"
              name="description" id="group-description"
              placeholder="This group has no description yet."></textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Create Group</button>
  </div>{{-- .form-group --}}
</form>
@endsection

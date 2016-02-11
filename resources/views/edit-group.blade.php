@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Group')
@section('content')
<a href="{{ url('groups') }}">&larr; Back to Groups</a>
<h2>Editing Group: {{ $group->name }}
<form class="form-inline" method="post" style="display:inline;"
      action="{{ url('group', [$group->id]) }}">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <button type="submit" class="btn btn-xs btn-danger">Leave This Group</button>
</form>
</h2>
<form method="post" id="edit-group-form"
      action="{{ url('edit-group') }}">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $group->id }}">
  <div class="form-group">
    <label for="group-name">Group Name</label>
    <input type="text" name="name" id="group-name"
           class="form-control" value="{{ $group->name }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="group-description">Group Description</label>
    <textarea class="form-control" name="description" rows="5"
              id="group-description">{{ $group->description }}</textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
  </div>{{-- .form-group --}}
</form>
<h2>Invite Others to Join This Group:</h2>
  <ul id="invite">
    @foreach ($users as $user)
      <li>
        <form method="post" action="{{ url('send-message') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="message"
                value="{{ Auth::user()->name }} has invited you to join
                     <a href='/join-group/{{ $group->id }}'
                        title='Join {{ $group->name}}'>{{ $group->name }}</a>">
            <button class="btn btn-lg btn-primary"
                type="submit">{{ $user->name }}</button>
        </form>
      </li>
    @endforeach
  </ul>
@endsection

@extends('layouts.base', ['show_logo' => true])

@section('title', 'Home')
@section('content')
<div id="groups">
  <h3>Groups</h3>
  <p>You are currently a member of
     <a href="{{ url('groups') }}">0 groups</a>.</p>
  <ul id="group-options">
    <li>Create a Group</li>
    <li>Join a Group</li>
  </ul>
</div>{{-- #groups --}}
@endsection

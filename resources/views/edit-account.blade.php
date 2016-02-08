@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Account')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
<form method="post" action="{{ url('user', [$user->id]) }}">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <button class="btn btn-lg btn-danger pull-right"
          type="submit">Delete This Account</button>
</form>
<h2>Editing Account: {{ $user->name }}</h2>
<form method="post" id="edit-user-form"
      action="{{ url('edit-account') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="user-name">User Name: </label>
    <input type="text" name="name" id="user-name"
           class="form-control" value="{{ $user->name }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="user-email">User Email: </label>
    <input type="text" name="email" id="user-email"
           class="form-control" value="{{ $user->email }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
  </div>{{-- .form-group --}}
</form>
@endsection

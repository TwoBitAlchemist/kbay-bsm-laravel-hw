@extends('layouts.base', ['show_logo' => true])

@section('title', 'Groups')
@section('content')
<form id="create-group-form" action="{{ url('groups') }}" method="post">
  <div class="form-group">
  </div>{{-- .form-group --}}
</form>
@endsection

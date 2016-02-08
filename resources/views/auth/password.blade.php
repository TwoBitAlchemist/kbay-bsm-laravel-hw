@extends('layouts.base', ['show_logo' => false])

@section('title', 'Send Password Reset Email')
@section('content')
<base target="_parent">
<div class="row">
  <div class="col-sm-4 col-sm-push-4" id="reset-form-block">
    <form method="post" action="/password/email">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control"
                   name="email" value="{{ old('email') }}">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-success">
                Send Password Reset Link
            </button>
        </div>{{-- .form-group --}}
    </form>
  </div>{{-- #reset-form-block --}}
</div>{{-- .row --}}

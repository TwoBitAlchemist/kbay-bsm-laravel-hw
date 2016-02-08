@extends('layouts.base', ['show_logo' => true])

@section('title', 'Welcome to PHP-Bookmarks.IO!')
@section('extrastyles')
<style>
    iframe {
      border: 0;
      height: 400px;
      width: 100%;
    }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-xs-5 col-xs-push-1" id="login_frame">
  <h2 class="text-center">
  Existing Users<br>
  <small><a href="/password/email">Forgot password?</a></small>
  </h2>
    <iframe src="{{ url('login') }}">
      Your browser is configured not to support iframes.<br>
      <a href="{{ url('login') }}">Go to Login page</a>
    </iframe>
  </div><!-- #login_frame -->
  <div class="col-xs-5 col-xs-push-1" id="register_frame">
  <h2 class="text-center">New Users<h2>
    <iframe src="{{ url('register') }}">
      Your browser is configured not to support iframes.<br>
      <a href="{{ url('register') }}">Go to Registration page</a>
    </iframe>
  </div><!-- #register_frame -->
</div><!-- .row -->
@endsection

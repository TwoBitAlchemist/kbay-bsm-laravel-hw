@extends('layouts.base', ['show_logo' => false])

@section('title', 'Log In')
@section('content')
<base target="_parent">
<form method="post" action="/login">
    {!! csrf_field() !!}
    <div class="row">
      <div id="login-block" class="col-sm-4 col-sm-push-4">
        <div class="form-group">
            <label for="email">Email Address: </label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email') }}">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" class="form-control"
                   name="password" id="password">
        </div>{{-- .form-group --}}
        <div class="form-group">
          <div class="col-sm-6">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
          </div>{{-- .col-sm-6 --}}
          <div class="col-sm-6">
            <button class="btn btn-block btn-success" 
                    type="submit">Log In</button>
          </div>{{-- .col-sm-6 --}}
        </div>{{-- .form-group --}}
      </div>{{-- #login-block --}}
    </div>{{-- .row --}}
</form>
@endsection

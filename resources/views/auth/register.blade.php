@extends('layouts.base', ['show_logo' => false])

@section('title', 'Sign Up')
@section('content')
<base target="_parent">
<form method="post" action="/register">
    {!! csrf_field() !!}
    <div class="row">
      <div id="register-block" class="col-sm-4 col-sm-push-4">
        <div class="form-group">
            <label for="reg_name">Name</label>
            <input type="text" name="name" id="reg_name" class="form-control"
                   value="{{ old('name') }}">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <label for="reg_email">Email Address</label>
            <input type="email" name="email" id="reg_email" class="form-control"
                   value="{{ old('email') }}">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <label for="reg_password">Password</label>
            <input type="password" class="form-control"
                   name="password" id="reg_password">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <label for="reg_password_conf">Confirm Password</label>
            <input type="password" class="form-control"
                   name="password_confirmation" id="reg_password_conf">
        </div>{{-- .form-group --}}
        <div class="form-group">
            <button class="btn btn-block btn-success"
                    type="submit">Sign Up</button>
        </div>{{-- .form-group --}}
      </div>{{-- #register-block --}}
    </div>{{-- .row --}}
</form>
@endsection

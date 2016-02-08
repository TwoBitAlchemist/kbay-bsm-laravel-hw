@extends('layouts.base', ['show_logo' => false])

@section('title', 'Reset Password')
@section('content')
<base target="_parent">
<form method="post" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label for="email">Email: </label>
        <input id="email" type="email" name="email" value="{{ old('email') }}">
    </div>{{-- .form-group --}}
    <div class="form-group">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
    </div>{{-- .form-group --}}
    <div class="form-group">
        <label for="password_c">Confirm Password: </label>
        <input type="password" name="password_confirmation" id="password_c">
    </div>{{-- .form-group --}}
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-success">
            Reset Password
        </button>
    </div>{{-- .form-group --}}
</form>

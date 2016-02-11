@extends('layouts.base', ['show_logo' => true])

@section('title', 'Unread Messages')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
<ul>
@foreach ($notifications as $notification)
  <li>{!! $notification->message !!}</li>
@endforeach
</ul>
@endsection

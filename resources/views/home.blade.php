@extends('layouts.base', ['show_logo' => true])

@section('title', 'Home')
@section('content')
<div class="row">
  <div id="main" class="col-xs-8">
    @include('home.category-view')
  </div>{{-- #main --}}
  <div id="sidebar" class="col-xs-4">
    @include('home.sidebar')
  </div>{{-- #sidebar --}}
</div>{{-- .row --}}
@endsection

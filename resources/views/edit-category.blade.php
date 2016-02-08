@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Category')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
<h2>Editing Category: {{ $category->name }}</h2>
<form method="post" id="edit-category-form"
      action="{{ url('edit-category') }}">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $category->id }}">
  <div class="form-group">
    <label for="name">Category Name: </label>
    <input type="text" name="name" id="category-name"
           class="form-control" value="{{ $category->name }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="description">Category Description: </label>
    <textarea class="form-control" name="description" rows="5"
              id="category-description">{{ $category->description }}</textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
  </div>{{-- .form-group --}}
</form>
@endsection

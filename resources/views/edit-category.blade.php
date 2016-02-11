@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Category')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
<div class="row">
  <div id="main" class="col-xs-8">
  @if (count($category->bookmarks) === 1)
    <p>This category has 1 bookmark.</p>
  @else
    <p>This category has {{ count($category->bookmarks) }} bookmarks.</p>
  @endif
    <ul class="row list-unstyled">
      @foreach ($bookmarks as $bookmark)
        <li class="col-sm-6 col-md-4">
        <dl>
          <dt>
            <form class="form-inline" method="post" style="display:inline;"
                  action="{{ url('bookmark', [$bookmark->id]) }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-xs btn-danger">Remove</button>
            </form>
            <a href="{{ url('edit-bookmark', [$bookmark->id]) }}">
                {{ $bookmark->name }}</a>&emsp;
            <a class="btn btn-success btn-xs" href="{{ $bookmark->url }}"
               target="_blank">Go &#x2197;<!-- northeast arrow --></a>
          </dt>
          <dd>{{ $bookmark->description }}</dd>
        </dl>
        </li>
      @endforeach
    </ul>
  <h2>Add a Bookmark to this Category:</h2>
  <form method="post" id="add-bookmark-form"
        action="{{ url('add-bookmark') }}">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ $category->id }}">
    <div class="form-group">
      <label for="bookmark-name">Bookmark Name</label>
      <input type="text" name="name" id="bookmark-name" class="form-control">
    </div>{{-- .form-group --}}
    <div class="form-group">
      <label for="bookmark-url">Bookmark URL</label>
      <input type="text" name="url" id="bookmark-url" class="form-control">
    </div>{{-- .form-group --}}
    <div class="form-group">
      <label for="bookmark-description">Bookmark Description</label>
      <textarea class="form-control" name="description"
                id="bookmark-description" rows="5"
                placeholder="No Description Yet."></textarea>
    </div>{{-- .form-group --}}
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Add Bookmark</button>
    </div>{{-- .form-group --}}
  </form>
  </div>{{-- #main --}}
  <div id="sidebar" class="col-xs-4">
  <h2>Editing Category: <br>{{ $category->name }}</h2>
  <form method="post" id="edit-category-form"
        action="{{ url('edit-category') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $category->id }}">
    <div class="form-group">
      <label for="category-name">Category Name</label>
      <input type="text" name="name" id="category-name"
             class="form-control" value="{{ $category->name }}">
    </div>{{-- .form-group --}}
    <div class="form-group">
      <label for="category-description">Category Description</label>
      <textarea class="form-control" name="description"
                id="category-description" rows="5"
                placeholder="{{ $category->description }}"></textarea>
    </div>{{-- .form-group --}}
    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
    </div>{{-- .form-group --}}
  </form>
  </div>{{-- #sidebar --}}
</div>{{-- .row --}}
@endsection

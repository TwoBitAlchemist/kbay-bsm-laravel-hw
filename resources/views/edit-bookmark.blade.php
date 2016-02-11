@extends('layouts.base', ['show_logo' => true])

@section('title', 'Edit Bookmark')
@section('content')
<a href="{{ url('home') }}">&larr; Back to Home</a>
<h2>Editing Bookmark: {{ $bookmark->name }}</h2>
<form method="post" id="edit-bookmark-form"
      action="{{ url('edit-bookmark') }}">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{ $bookmark->id }}">
  <div class="form-group">
    <label for="bookmark-name">Bookmark Name: </label>
    <input type="text" name="name" id="bookmark-name"
           class="form-control" value="{{ $bookmark->name }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="bookmark-url">Bookmark URL: </label>
    <input type="text" name="url" id="bookmark-url"
           class="form-control" value="{{ $bookmark->url }}">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="bookmark-description">Bookmark Description: </label>
    <textarea class="form-control" name="description" rows="5"
              id="bookmark-description">{{ $bookmark->description }}</textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Save Changes</button>
  </div>{{-- .form-group --}}
</form>
<h2>Share This Bookmark with Other Users:</h2>
  <ul id="invite">
    @foreach ($users as $user)
      <li>
        <form method="post" action="{{ url('send-message') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="message"
                value="{{ Auth::user()->name }} has suggested you
                add this bookmark:
                     <a href='{{ $bookmark->url }}'
                        title='{{ $bookmark->description}}'>{{ $bookmark->name }}
                     </a>">
            <button class="btn btn-lg btn-primary"
                type="submit">{{ $user->name }}</button>
        </form>
      </li>
    @endforeach
  </ul>
@endsection

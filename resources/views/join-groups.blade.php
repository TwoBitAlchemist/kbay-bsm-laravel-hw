@extends('layouts.base', ['show_logo' => true])

@section('title', 'Find Groups to Join')
@section('content')
<a href="{{ url('groups') }}">&larr; Back to Groups</a>
<h2>You can join the following groups:</h2>
<ul id="group-list" class="list-unstyled">
  @foreach ($groups as $group)
    <li>
      <dl>
        <dt>
            <a href="{{ url('join-group', [$group->id]) }}">
                {{ $group->name }}</a>
        </dt>
        <dd>{{ $group->description }}</dd>
      </dl>
    </li>
  @endforeach
@endsection

<h3>Groups</h3>
@if (count($groups) === 1)
  <p>You are currently in only
     <a href="{{ url('groups') }}">1 group</a>.</p>
@else
  <p>You are currently in
     <a href="{{ url('groups') }}">{{ count($groups) }} groups</a>.</p>
@endif
<ul id="group-options">
  <li><a href="{{ url('groups') }}">Create a Group</a></li>
  <li><a href="{{ url('join-groups') }}">Join a Group</a></li>
</ul>

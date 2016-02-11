<div id="groups">
  <a class="twitter-timeline" href="https://twitter.com/hashtag/PHP" data-widget-id="697650961465139200">#PHP Tweets</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  <hr>
  <ul>
    <li>
      <a href="/messages/unread">Notifications ({{ count($notifications) }})</a>
    </li>
    <li><a href="/edit-account">Edit Account</a></li>
    <li><a href="/logout">Sign Out</a></li>
  </ul>
  <hr>
  @include('home.group-widget')
  <hr>
  @include('home.category-form')
</div>{{-- #groups --}}

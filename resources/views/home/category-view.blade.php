<div id="categories">
  <h2>Categories</h2>
  @if (count($categories) === 1)
    <p>You have only 1 category.</p>
  @else
    <p>You have {{ count($categories) }} categories.</p>
  @endif
  <ul class="list-unstyled">
  @foreach ($categories as $category)
    <li><dl>
      <dt>
        <form class="form-inline" method="post" style="display:inline;"
              action="{{ url('category', [$category->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-xs btn-danger">Remove</button>
        </form>
        &emsp;
        <a href="{{ url('edit-category', [$category->id]) }}">
          {{ $category->name }}</a>
      </dt>
      <dd>{{ $category->description }}</dd>
    </dl></li>
  @endforeach
  </ul>
</div>

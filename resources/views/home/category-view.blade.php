<div id="categories">
  <h2>Categories</h2>
  @if (count($categories) === 1)
    <p>You have only 1 category.</p>
  @elseif (count($categories) === 0)
    <p class="alert alert-info"><strong>Welcome!</strong>
        You have no categories yet.
        Add a category to get started!</p>
  @else
    <p>You have {{ count($categories) }} categories.</p>
  @endif
  <ul class="row list-unstyled">
  @foreach ($categories as $category)
    <li class="col-sm-6 col-md-4">
    <dl>
      <dt>
        <a href="{{ url('edit-category', [$category->id]) }}">
          {{ $category->name }}</a>
        <form class="form-inline pull-right" method="post"
              action="{{ url('category', [$category->id]) }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-xs btn-danger">Remove</button>
        </form>
      </dt>
      <dd>{{ $category->description }}</dd>
    </dl>
    </li>
  @endforeach
  </ul>
</div>

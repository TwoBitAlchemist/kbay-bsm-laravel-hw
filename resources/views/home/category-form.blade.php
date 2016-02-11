<h3>Add a Category Below: </h3>
<form method="post" id="add-category-form"
      action="{{ url('add-category') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" name="name" id="category-name" class="form-control">
  </div>{{-- .form-group --}}
  <div class="form-group">
    <label for="description">Category Description</label>
    <textarea class="form-control" name="description"
              id="category-description" rows="5"
              placeholder="No description yet."></textarea>
  </div>{{-- .form-group --}}
  <div class="form-group">
    <button type="submit" class="btn btn-lg btn-success">Add Category</button>
  </div>{{-- .form-group --}}
</form>

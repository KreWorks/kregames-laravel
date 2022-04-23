@if (isset($entity))
<form method="POST" action="{{ route('admin.rating_categories.update', $entity->id) }}" enctype="multipart/form-data" name="rating_category-form" id="rating_category-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.rating_categories.store')}}" enctype="multipart/form-data" name="rating_category-form" id="rating_category-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : '' }}" id="name" name="name" onkeyup="document.getElementById('slug').value = createSlug(value)">
            </div>
            <div class="form-group col-lg-12">
                <label for="slug" class="col-form-label">Slug</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->slug : ''}}" id="slug" name="slug">
            </div>
            <div class="form-group col-lg-12">
                <label for="fontawesome" class="col-form-label">FontAwesome</label>
                <input class="form-control" type="text" value="{{ isset($entity) ?  $entity->fontawesome : ''}}" id="fontawesome" name="fontawesome">
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.rating_categories.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

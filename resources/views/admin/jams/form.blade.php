@if (isset($entity))
<form method="POST" action="{{ route('admin.jams.update', $entity->id) }}" enctype="multipart/form-data" name="jam-form" id="jam-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.jams.store')}}" enctype="multipart/form-data" name="jam-form" id="jam-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : '' }}" id="name" name="name" onkeyup="document.getElementById('slug').value = createSlug(value)">
            </div>
            <div class="form-group col-lg-12">
                <label for="slug" class="col-form-label">Slug</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->slug : '' }}" id="slug" name="slug">
            </div>
            <div class="form-group col-lg-12">
                <label for="entries" class="col-form-label">Indulók</label>
                <input class="form-control" type="number" value="{{ isset($entity) ? $entity->entries : '' }}" id="entries" name="entries">
            </div>
            <div class="form-group col-lg-12">
                <label for="theme" class="col-form-label">Téma</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->theme : '' }}" id="theme" name="theme">
            </div>
            <div class="form-group col-lg-12">
                <label for="start_date" class="col-form-label">Kezdés</label>
                <input class="form-control" type="datetime-local" value="{{ isset($entity) ? str_replace(' ', 'T', $entity->start_date) : '' }}" id="start_date" name="start_date">
            </div>
            <div class="form-group col-lg-12">
                <label for="end_date" class="col-form-label">Vég</label>
                <input class="form-control" type="datetime-local" value="{{ isset($entity) ? str_replace(' ', 'T', $entity->end_date) : '' }}" id="end_date" name="end_date">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="icon" class="form-label">Logó</label>
                <input class="form-control" type="file" id="icon" name="icon">
            </div>
            <div class="col-lg-12">
                <img class="col-lg-3" src="/{{isset($entity) && $entity->icon ? $entity->icon->path : ''}}">
            </div>

        </div>
    </div>

    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.jams.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" data-bs-dismiss>Mentés</button>
    </div>
</form>


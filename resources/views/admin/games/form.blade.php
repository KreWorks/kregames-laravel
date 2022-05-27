@if (isset($entity))
<form method="POST" action="{{ route('admin.games.update', $entity->id) }}" enctype="multipart/form-data" name="game-form" id="game-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.games.store')}}" enctype="multipart/form-data" name="game-form" id="game-form">
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
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->slug : ''}}" id="slug" name="slug">
            </div>
            <div class="form-group col-lg-12">
                <label for="publish_date" class="col-form-label">Megjelenés dátuma</label>
                <input class="form-control" type="datetime-local" value="{{ isset($entity) ? str_replace(' ', 'T', $entity->publish_date) : time() }}" id="publish_date" name="publish_date">
            </div>
            <div class="form-group col-lg-12">
                <label for="jam_id" class="col-form-label">Jam</label>
                <select class="form-control" id="jam_id" name="jam_id">
                    <option value="0" {{ isset($entity) && $entity->jam_id == '' ? 'selected' : ''}}>Nincs jam</option>
                    @foreach($extraDatas['jams'] as $jam)
                        <option value="{{$jam->id}}" {{isset($entity) && $entity->jam_id == $jam->id ? 'selected' : ''}}>{{$jam->name}}</option>

                    @endforeach
                <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="publish_date" class="col-form-label">Láthatóság</label>  
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ isset($entity) && $entity->visible ? 'checked' : '' }} onchange="onChange(this)">
                    <label class="form-check-label" for="visible">
                        <div class="btn btn-success disabled {{ isset($entity) && $entity->visible ? '' : 'd-none' }}" id="visible_true">
                            <i class="fa fa-eye fa-lg"></i>
                        </div>
                        <div class="btn btn-danger disabled {{ isset($entity) && $entity->visible ? 'd-none' : '' }}" id="visible_false">
                            <i class="fa fa-eye-slash fa-lg"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="icon" class="form-label">Logó</label>
                <input class="form-control" type="file" id="icon" name="icon">
            </div>
            <div class="col-lg-12">
                <img class="col-lg-3" src="/{{ isset($entity) && $entity->icon ? $entity->icon->path : '' }} ">
            </div>

        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.games.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

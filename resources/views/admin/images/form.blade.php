@if (isset($entity))
<form method="POST" action="{{ route('admin.images.update', $entity->id) }}" enctype="multipart/form-data" name="image-form" id="image-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.images.store')}}" enctype="multipart/form-data" name="image-form" id="image-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <input type="hidden" id="imageable_type" name="imageable_type" value="{{$imageable_type}}">
    <input type="hidden" id="imageable_id" name="imageable_id" value="{{$imageable_id}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="type" class="col-form-label">Típus</label>
                <select class="form-control" id="type" name="type">
                    <option value="0" {{ isset($entity) && $entity->type == '' ? 'selected' : ''}}>Nincs típus</option>
                    @foreach($extraDatas['imagetypes'] as $typeIndex => $type)
                        <option value="{{$typeIndex}}" {{isset($entity) && $entity->type == $typeIndex ? 'selected' : ''}}>{{$type}}</option>

                    @endforeach
                <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="title" class="col-form-label">Leírás</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->title : ''}}" id="title" name="title">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="image" class="form-label">Kép</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="col-lg-12">
                <img class="col-lg-3" src="/{{ isset($entity) ? $entity->path : '' }} ">
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

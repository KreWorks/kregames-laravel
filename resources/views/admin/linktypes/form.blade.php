@if (isset($entity))
<form method="POST" action="{{ route('admin.linktypes.update', $entity->id) }}" enctype="multipart/form-data" name="linktype-form" id="linktype-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.linktypes.store')}}" enctype="multipart/form-data" name="linktype-form" id="linktype-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : ''}}" id="name" name="name" >
            </div>
            <div class="form-group col-lg-12">
                <label for="fontawesome" class="col-form-label">Font Awesome</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->fontawesome : ''}}" id="fontawesome" name="fontawesome">
            </div>
            <div class="form-group col-lg-12">
                <label for="color" class="col-form-label">Szín</label>
                <input class="form-control" type="color" value="{{ isset($entity) ? $entity->color : ''}}" id="color" name="color" style="height:50px;width:100px">
            </div>
        </div>                 
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.linktypes.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

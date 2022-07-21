@if (isset($entity))
<form method="POST" action="{{ route('admin.languages.update', $entity->id) }}" name="language-form" id="language-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.languages.store')}}" name="language-form" id="language-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-lg-12">
                <label for="short" class="col-form-label">Rövid név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->short : ''}}" id="short" name="short" >
            </div>
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : ''}}" id="name" name="name">
            </div>
            <div class="form-group col-lg-12">
                <label for="color" class="col-form-label">Aktív</label>
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
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.languages.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

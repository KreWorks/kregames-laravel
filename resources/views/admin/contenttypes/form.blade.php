@if (isset($entity))
<form method="POST" action="{{ route('admin.contenttypes.update', $entity->id) }}" name="language-form" id="language-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.contenttypes.store')}}" name="language-form" id="language-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">            
            <div class="form-group col-lg-12">
                <label for="model" class="col-form-label">Típus</label>
                <select class="form-control" id="model" name="model" >
                    @foreach($extraDatas['types'] as $name => $type)
                        <option value="{{$type}}" {{ (isset($entity) && $entity->model == $type) ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : ''}}" id="name" name="name">
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

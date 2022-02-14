@if (isset($entity))
<form method="POST" action="{{ route('admin.links.update', $entity->id) }}" enctype="multipart/form-data" name="link-form" id="link-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.links.create')}}" enctype="multipart/form-data" name="link-form" id="link-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="link" class="col-form-label">Link</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->link : '' }}" id="link" name="link">
            </div>
            <div class="form-group col-lg-12">
                <label for="display_text" class="col-form-label">Megjelenő szöveg</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->display_text : ''}}" id="display_text" name="display_text">
            </div>
            <div class="form-group col-lg-12">
                <label for="linktype_id" class="col-form-label">Linktípus</label>
                <select class="form-control" id="linktype_id" name="linktype_id">
                    <option value="0" {{ isset($entity) && $entity->linktype_id == '' ? 'selected' : ''}}>Nincs típus</option>
                    @foreach($extraDatas['linktypes'] as $linktype)
                        <option value="{{$linktype->id}}" {{isset($entity) && $entity->linktype_id == $linktype->id ? 'selected' : ''}}>{{$linktype->name}}</option>

                    @endforeach
                    <select>
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.links.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

@if (isset($entity))
<form method="POST" action="{{ route('admin.category_jam.update', $entity->id) }}" enctype="multipart/form-data" name="category_jam-form" id="category_jam-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.category_jam.store')}}" enctype="multipart/form-data" name="category_jam-form" id="category_jam-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            @if (!isset($jam_id))
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Jam</label>
                <select class="form-control" id="jam_id" name="jam_id">
                    <option value="0" {{ isset($entity) && $entity->jam_id == '' ? 'selected' : ''}}>Nincs jam</option>
                    @foreach($extraDatas['jams'] as $jam)
                        <option value="{{$jam->id}}" {{ (isset($entity) && $entity->jam_id == $jam->id) || (isset($jam_id) && $jam_id == $jam->id) ? 'selected' : ''}}>{{$jam->name}}</option>

                    @endforeach
                <select>
            </div>
            @else 
            <input type="hidden" id="jam_id" name="jam_id" value="{{$jam_id}}">
            @endif
            <div class="form-group col-lg-12">
                <label for="slug" class="col-form-label">Értékelési kategória</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="0" {{ isset($entity) && $entity->category_id == '' ? 'selected' : ''}}>Nincs kategória</option>
                    @foreach($extraDatas['categories'] as $category)
                        <option value="{{$category->id}}" {{isset($entity) && $entity->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                <select>
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.category_jam.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
    <input type="hidden" id="redirect_route" name="redirect_route" value="{{isset($redirectUrl) ? $redirectUrl : ''}}">
</form>

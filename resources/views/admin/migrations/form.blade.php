@if (isset($entity))
<form method="POST" action="{{ route('admin.migrations.update', $entity->id) }}" enctype="multipart/form-data" name="game-form" id="game-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.migrations.store')}}" enctype="multipart/form-data" name="game-form" id="game-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="migration" class="col-form-label">Migration</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->migration : '' }}" id="migration" name="migration" >
            </div>
            <div class="form-group col-lg-12">
                <label for="batch" class="col-form-label">Batch</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->batch : ''}}" id="batch" name="batch">
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.migrations.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

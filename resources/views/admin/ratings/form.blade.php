@if (isset($entity))
<form method="POST" action="{{ route('admin.ratings.update', $entity->id) }}" enctype="multipart/form-data" name="rating-form" id="rating-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.ratings.store')}}" enctype="multipart/form-data" name="rating-form" id="rating-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-lg-12">
                <label for="game_id" class="col-form-label">Játék</label>
                <select class="form-control" id="game_id" name="game_id">
                    <option value="0" {{ isset($entity) && $entity->game_id == '' ? 'selected' : ''}}>Nincs játék</option>
                    @foreach($extraDatas['games'] as $game)
                        <option value="{{$game->id}}" {{isset($entity) && $entity->game_id == $game->id ? 'selected' : ''}}>{{$game->name}}</option>

                    @endforeach
                <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="category_id" class="col-form-label">Kategória</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="0" {{ isset($entity) && $entity->category_id == '' ? 'selected' : ''}}>Nincs kategória</option>
                    @foreach($extraDatas['categories'] as $category)
                        <option value="{{$category->id}}" {{isset($entity) && $entity->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="rank" class="col-form-label">Helyezés</label>
                <input class="form-control" type="number" value="{{ isset($entity) ? $entity->rank : ''}}" id="rank" name="rank">
            </div>
            <div class="form-group col-lg-12">
                <label for="average_point" class="col-form-label">Átlag pont</label>
                <input class="form-control" type="number" value="{{ isset($entity) ? $entity->average_point : ''}}" id="average_point" name="average_point">
            </div>
            <div class="form-group col-lg-12">
                <label for="rating_count" class="col-form-label">Szavazatok száma</label>
                <input class="form-control" type="number" value="{{ isset($entity) ? $entity->rating_count : ''}}" id="rating_count" name="rating_count">
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.ratings.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>

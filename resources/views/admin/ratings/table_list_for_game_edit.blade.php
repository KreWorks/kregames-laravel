<table class="table table-striped table-hover">
    <thead>
    <tr>
        @foreach($tableLabels as $column)
            <th scope="col">{{ ucfirst($column) }}</th>
        @endforeach
        <th scope="col">Műveletek</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <?php $ratingData = null; 
            foreach($datas as $data) {
                if($category->id == $data->category->id) {
                    $ratingData = $data;
                }
            }
            ?>
            @if($ratingData == null)
            <form method="POST" action="{{ route('admin.ratings.store')}}" name="rating-form" id="rating-form">
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                <input type="hidden" id="game_id" name="game_id" value="{{$game->id}}">
                <input type="hidden" id="category_id" name="category_id" value="{{$category->id}}">
                <td class="align-middle">#</td>
                <td class="align-middle"><i class="fa fa-2x {{$category->fontawesome }}" style="color: #666666"></i>{{$category->name}}</td>
                <td class="align-middle"><input type="text" class="form-control" id="rank" name="rank" value=""></td>
                <td class="align-middle"><input type="text" class="form-control" id="average_point" name="average_point" value=""></td>
                <td class="align-middle"><input type="text" class="form-control" id="rating_count" name="rating_count" value=""></td>
                <td class="align-middle">
                    <ul class="list-inline" style="margin-bottom:0px;">
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-floppy-disk fa-lg"></i>
                            </button>
                        </li>
                    </ul>
                </td>
            </form>
            @else 
            <form method="POST" action="{{route('admin.ratings.update', $ratingData->id)  }}" name="rating-form" id="rating-form">
                @method('PUT')
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                <td class="align-middle">{{$ratingData->id }}</td>
                <td class="align-middle"><i class="fa fa-2x {{$ratingData->category->fontawesome}}" style="color: #666666"></i>{{$ratingData->category->name}}</td>
                <td class="align-middle"><input type="text" class="form-control rank-{{$ratingData->id}}" id="rank" name="rank" value="{{$ratingData->rank }}" disabled></td>
                <td class="align-middle"><input type="text" class="form-control average_point-{{$ratingData->id}}" id="average_point" name="average_point" value="{{$ratingData->average_point}}"  disabled></td>
                <td class="align-middle"><input type="text" class="form-control rating_count-{{$ratingData->id}}" id="rating_count" name="rating_count" value="{{$ratingData->rating_count}}" disabled></td>
                <td class="align-middle">
                    <ul class="list-inline" style="margin-bottom:0px;">
                        <li class="list-inline-item">
                            <button type="button" class="btn btn-info edit-btn-{{$ratingData->id}}" onclick="enableEdit({{$ratingData->id}});">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button type="submit" class="btn btn-success submit-btn-{{$ratingData->id}}" style="display:none;">
                                <i class="fa fa-floppy-disk fa-lg"></i>
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <div class="btn btn-danger"
                                data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{ route('admin.ratings.destroy', $data->id) }}',
                                    `{{$data->deleteString}}`, '{{$redirectUrl}}');">
                                <i class="fa fa-trash-can fa-lg"></i>
                            </div>
                        </li>
                    </ul>
                </td>
            </form>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

<td class="align-middle">{{$data->id}}</td>
@if(array_key_exists('jam', $tableLabels))
<td class="align-middle">{{$data->jam->name}}</td>
@endif
<td class="align-middle">{{$data->name}}</td>
<td class="align-middle"><i class="fa fa-2x {{$data->fontawesome}}" style="color: #666666"></td>
<td class="align-middle">
    <ul class="list-inline" style="margin-bottom:0px;">
        <li class="list-inline-item">
            <form action="{{route('admin.category_jam.edit', $data->id) }}" method="GET">
                <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                <button type="submit" class="btn btn-info" >
                    <i class="fa fa-edit fa-lg"></i>
                </button>
            </form>
        </li>
        <li class="list-inline-item">
            <div class="btn btn-danger"
                data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{ route('admin.category_jam.destroy', $data->id) }}',
                    `{{$data->deleteString}}`, '{{$redirectUrl}}');">
                    <i class="fa fa-trash-can fa-lg"></i>
            </div>
        </li>
    </ul>
</td>
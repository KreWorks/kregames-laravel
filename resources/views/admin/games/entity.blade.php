<td class="align-middle"><img src="/{{ $data->icon ? $data->icon->path : '' }}" style="width:50px; height:50px;" alt="icon"></td>
<td class="align-middle">{{$data->id}}</td>
<td class="align-middle">{{$data->name}}</td>
<td class="align-middle">{{$data->jam->name}}</td>
<td class="align-middle">{{$data->publish_date}}</td>
<td class="align-middle">
@if($data->visible)
    <div class="btn btn-success disabled" >
        <i class="fa fa-eye fa-lg"></i>
    </div>
@else
    <div class="btn btn-danger disabled">
        <i class="fa fa-eye-slash fa-lg"></i>
    </div>
@endif
</td>
<td class="align-middle">
    <ul class="list-inline" style="margin-bottom:0px;">
        <li class="list-inline-item">
            <form action="{{route('admin.games.edit', $data->id) }}" method="GET">
                <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                <button type="submit" class="btn btn-info" >
                    <i class="fa fa-edit fa-lg"></i>
                </button>
            </form>
        </li>
        <li class="list-inline-item">
            <div class="btn btn-danger"
                data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{ route('admin.games.destroy', $data->id) }}',
                    `{{$data->deleteString}}`, '{{$redirectUrl}}');">
                <i class="fa fa-trash-can fa-lg"></i>
            </div>
        </li>
    </ul>
</td>
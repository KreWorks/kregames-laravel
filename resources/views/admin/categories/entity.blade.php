<td clas="align-middle">{{$data->id}}</td>
<td clas="align-middle">{{$data->name}}</td>
<td clas="align-middle"><i class="fa fa-2x {{$data->fontawesome}}" style="color: #666666"></td>
<td class="align-middle">
    <ul class="list-inline" style="margin-bottom:0px;">
        <li class="list-inline-item">
            <form action="{{route('admin.'.$route.'.edit', $data->id) }}" method="GET">
                <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                <button type="submit" class="btn btn-info" >
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                    </svg>
                </button>
            </form>
        </li>
        <li class="list-inline-item">
            <div class="btn btn-danger"
                data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{ route("admin.".$route.".destroy", $data->id) }}',
                    '{{$data->deleteString}}', '{{$redirectUrl}}');">
                <svg class="card__icon--delete">
                    <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                </svg>
            </div>
        </li>
    </ul>
</td>
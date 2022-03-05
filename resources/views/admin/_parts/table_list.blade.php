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
    @foreach($datas as $data)
        <tr>
            @foreach($tableLabels as $key => $column)
                <td class="align-middle">
                    @if ($key == 'iconPath' || $key == 'path' || $key == 'avatarPath')
                        <img src="/{{ $data->__get($key) }}" style="width:50px; height:50px;" alt="icon">
                    @elseif ($key == 'fontawesome')
                        <i class="fa fa-3x {{$data->__get('fontawesome_icon')}}" style="color: {{$data->fontawesome_color}}">
                    @else
                        {{ $data->__get($key) }}
                    @endif
                </td>
            @endforeach
            <td class="align-middle">
                <ul class="list-inline" style="margin-bottom:0px;">
                    <li class="list-inline-item">
                        <form action="{{route('admin.'.$route.'.edit', $data->id) }}" method="GET">
                            <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                            <button type="submit" class="btn btn-primary" >
                                <svg class="card__icon--delete">
                                    <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                                </svg>
                            </button>
                        </form>
                    </li>
                    <li class="list-inline-item">
                        <div class="btn btn-danger"
                            data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$route.'.destroy', $data->id) }}', '{{$data->deleteString}}', '{{$redirectUrl}}')">
                            <svg class="card__icon--delete">
                                <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                            </svg>
                        </div>
                    </li>
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

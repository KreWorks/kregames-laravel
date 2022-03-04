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
    @foreach($datas as $entity)
        <tr>
            @foreach($tableLabels as $key => $column)
                <td class="align-middle">
                    @if ($key == 'iconPath' || $key == 'path' || $key == 'avatarPath')
                        <img src="/{{ $entity->__get($key) }}" style="width:50px; height:50px;" alt="icon">
                    @elseif ($key == 'fontawesome')
                        <i class="fa fa-3x {{$entity->__get('fontawesome_icon')}}" style="color: {{$entity->fontawesome_color}}">
                    @else
                        {{ $entity->__get($key) }}
                    @endif
                </td>
            @endforeach
            <td>
                <form action="{{route('admin.'.$route.'.edit', $entity->id) }}" method="GET">
                    <input type="hidden" id="redirectRoute" name="redirectRoute" value="{{ route('admin.'.$route.'.edit', $entity->id) }}">
                    <button type="button" class="btn btn-primary" >
                        <svg class="card__icon--delete">
                            <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                        </svg>
                    </button>
                </form>
                <div class="btn btn-danger"
                     data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$route.'.destroy', $entity->id) }}', '{{$entity->name}}' )">
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                    </svg>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

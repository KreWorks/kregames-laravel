<table class="table table-striped table-hover">
    <thead>
    <tr>
        @foreach($table as $column)
            <th scope="col">{{ $column }}</th>
        @endforeach
        <th scope="col">Műveletek</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $entity)
        <tr>
            @foreach($table as $key => $column)
                <td class="align-middle">
                    @if ($key == 'iconPath' || $key == 'path' || $key == 'avatarPath')
                        <img src="/{{ $entity->__get($key) }}" style="width:50px; height:50px;" alt="icon">
                    @else
                        {{ $entity->__get($key) }}
                    @endif
                </td>
            @endforeach
            <td>
                <a class="btn btn-primary"  href="{{route('admin.'.$routeName.'.edit', $entity->id) }}" >
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                    </svg>
                </a>

                <div class="btn btn-danger"
                     data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$routeName.'.destroy', $entity->id) }}', '{{ $entity->deleteString }}' )">
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                    </svg>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

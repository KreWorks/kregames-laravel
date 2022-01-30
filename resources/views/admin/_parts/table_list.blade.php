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
                    @else
                        {{ $entity->__get($key) }}
                    @endif
                </td>
            @endforeach
            <td>
                <button type="button" class="btn btn-primary"  href="{{route('admin.'.$route.'.edit', $entity->id) }}"
                        onclick="openModal('{{$name}}', '{{ucfirst($hunName)}}', 'update', '{{route('admin.'.$route.'.update', $entity->id)}}','{{route('admin.'.$route.'.show', $entity->id)}}' )"
                        >
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                    </svg>
                </button>

                <div class="btn btn-danger"
                     data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('alma', 'alma' )">
                    <svg class="card__icon--delete">
                        <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                    </svg>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

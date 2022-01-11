@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white p-3">
                Jamek
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="pagefilter" id="pagefilter" class="form-control"
                               placeholder="Filter Jams ...">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="addJamButton"
                                data-bs-toggle="modal" data-bs-target="#addJam" >
                            Új jam
                        </button>
                    </div>
                </div>
            </div>
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
                                    <img src="/{{ $entity->__get($key) }}" style="width:50px; height:50px;">
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
        </div>
@endsection

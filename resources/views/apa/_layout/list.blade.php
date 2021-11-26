@extends('apa._layout.login_layout')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$controller}} | {{$action}}</h1>
    </div>
    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
    <div class="d-flex justify-content-between">
        <a href="new.html" class="btn btn-primary">{{$newBtnText}}</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                @foreach($table as $column)
                    <th class="text-center align-middle" scope="col">{{ ucfirst($column) }}</th>
                @endforeach
                    <th class="text-center align-middle" scope="col">Műveletek</th>  
                </tr>
            </thead>
        <tbody>
        @foreach($datas as $entity)
        <tr>
            @foreach($table as $key => $column)
            <td class="text-center align-middle">
                @if ($key == 'iconPath' || $key == 'path' || $key == 'avatarPath')
                <img src="/{{ $entity->__get($key) }}" style="width:50px; height:50px;">
                @else
                {{ $entity->__get($key) }}
                @endif
            </td>
            @endforeach
            <td class="text-center">
                <ul class="d-flex justify-content-center " style="list-style-type:none">
                    <li class="mr-3">
                        <a href="{{route('admin.'.$routeName.'.edit', $entity->id) }}" class="text-secondary">
                        <button class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                        </button>
                        </a>
                    </li>
                    <li>
                        <button class="btn btn-danger"
                        data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$routeName.'.destroy', $entity->id) }}', '{{ $entity->deleteString }}' )">
                            <i class="fa fa-trash"></i>
                        </button>
                    </li>
                </ul>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</main>

@endsection
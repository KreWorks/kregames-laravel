@extends('admin._layout.login_layout')

@section('content')
<div class="main-content-inner">
    <div class="row">
        <!-- Hoverable Rows Table start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.'.$routeName.'.create') }}">    
                        <button class="btn btn-primary">{{ $newBtnText}}</button>
                    </a>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
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
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3">
                                                    <a href="{{route('admin.'.$routeName.'.edit', $entity->id) }}" class="text-secondary">
                                                    <button class="btn btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger"
                                                    data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$routeName.'.destroy', $entity->id) }}', '{{ $entity->deleteString }}' )"><i class="ti-trash"></i></button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hoverable Rows Table end -->
    </div>
</div>
@include('admin._layout.delete_modal')
            
@endsection

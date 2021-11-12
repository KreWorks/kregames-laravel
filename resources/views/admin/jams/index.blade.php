@extends('admin._layout.login_layout')

@section('content')
            <div class="main-content-inner">
                <div class="row">
                    <!-- Hoverable Rows Table start -->
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route($newRoute) }}">    
                                    <button class="btn btn-primary">{{ $newRouteText}}</button>
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
                                                    <td>{{ $entity->__get($key) }}</td>
                                                    @endforeach
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3">
                                                                <a href="{{route('admin.jams.edit', $entity->id) }}" class="text-secondary"><i class="fa fa-edit"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.jams.destroy', $entity->id) }}" class="text-danger"><i class="ti-trash"></i></a>
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

            
@endsection

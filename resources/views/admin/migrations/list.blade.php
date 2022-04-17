@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row"> 
                    <span class="col-md-8 my-auto">Migrations lista</span>
                    <form class="col-md-3 float-right" action="{{route('admin.migrations.store')}}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                        <input type="hidden" id="unstored" name="unstored" value="all">
                        <button type="submit" class="btn btn-warning" >
                            Új migrációk futtatása
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Migration</th>
                        <th scope="col">Table</th>
                        <th scope="col">HelperClassName</th>

                        <th scope="col">Batch</th>
                        <th scope="col">Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $redirectUrl = "";
                        ?>
                    @foreach($datas as $fileName => $data)
                        @if($data != null)
                        <tr class="table-success">
                            <td class="align-middle">{{$data->id}}</td>
                            <td class="align-middle">{{$data->migration}}</td>
                            <td class="align-middle">{{$data->tableName}}</td>
                            <td class="align-middle">{{$data->helperClassName}}</td>
                            <td class="align-middle">{{$data->batch}}</td>
                        @else
                        <tr class="table-danger">
                            <td class="align-middle">##</td>
                            <td class="align-middle">{{$fileName}}</td>
                            <td class="align-middle">{{ App\Models\Migration::GetTableName($fileName)}}</td>
                            <td class="align-middle">{{ App\Models\Migration::GenerateHelperClassName($fileName)}}</td>
                            <td class="align-middle"></td>
                        @endif
                            <td class="align-middle">
                                <ul class="list-inline" style="margin-bottom:0px;">
                                <?php 
                                $id = $data != null ? $data->id : 0;
                                ?>
                                @if($data != null && $data->tableName == 'users')
                                    <li class="list-inline-item ">
                                        <form action="{{route('admin.migrations.userrebuild') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info" >
                                                <i class="fa fa-recycle fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    @if($data != null && $data->hasSeeder())
                                    <li class="list-inline-item ms-5">|</li>
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.edit', $id)}}" method="GET">
                                            <button type="submit" class="btn btn-warning {{$data == null ? 'disabled' : ''}}" >
                                                <i class="fa-solid fa-seedling fa-lg"></i>
                                            </button>    
                                        </form>
                                    </li>
                                    @endif
                                @else
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="migration_file" name="migration_file" value="{{$fileName}}">
                                            <button type="submit" class="btn btn-success {{$data != null ? 'disabled' : ''}}" >
                                                <i class="fa fa-arrow-up fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.destroy', $id) }}" method="POST">
                                            @method('DELETE') 
                                            @csrf
                                            <button type="submit" class="btn btn-danger {{$data == null ? 'disabled' : ''}}" >
                                                <i class="fa fa-arrow-down fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    @if($data != null && $data->hasSeeder())
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.edit', $id)}}" method="GET">
                                            <button type="submit" class="btn btn-warning {{$data == null ? 'disabled' : ''}}" >
                                                <i class="fa-solid fa-seedling fa-lg"></i>
                                            </button>    
                                        </form>
                                    </li>
                                    @endif
                                @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal-->
@endsection

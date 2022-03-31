@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Migrations lista</span>
                    <form action="{{route('admin.migrations.store')}}" method="POST">
                        @csrf
                        <input type="hidden" id="unstored" name="unstored" value="all">
                        <button type="submit" class="btn btn-warning col-md-3 float-right">
                            Hiányzó migration-ök futtatása
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
                        <th scope="col">HelperClassName</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $redirectUrl = "";
                        ?>
                    @for($index = 0; $index < count($files); $index++)
                        @if(count($datas) > $index)
                        <tr class="table-success">
                            <td class="align-middle">{{$datas[$index]->id}}</td>
                            <td class="align-middle">{{$datas[$index]->migration}}</td>
                            <td class="align-middle">{{$datas[$index]->helperClassName}}</td>
                            <td class="align-middle">{{$datas[$index]->batch}}</td>
                        @else
                        <tr class="table-danger">
                            <td class="align-middle">##</td>
                            <td class="align-middle">{{$files[$index]}}</td>
                            <td class="align-middle">{{ App\Models\Migration::GenerateHelperClassName($files[$index])}}</td>
                            <td class="align-middle"></td>
                        @endif
                            <td class="align-middle">
                                <ul class="list-inline" style="margin-bottom:0px;">
                                <?php 
                                $id = count($datas) > $index ? $datas[$index]->id : 0;
                                ?>
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.store') }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" id="migration_file" name="migration_file" value="{{$files[$index]}}">
                                            <button type="submit" class="btn btn-success {{$id != 0 ? 'disabled' : ''}}" >
                                                <i class="fa fa-arrow-up fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        
                                        <form action="{{route('admin.migrations.destroy', $id) }}" method="POST">
                                            @method('DELETE') 
                                            @csrf
                                            <button type="submit" class="btn btn-danger {{$id == 0 ? 'disabled' : ''}}" >
                                                <i class="fa fa-arrow-down fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                @if($id != 0 && $datas[$index]->hasSeeder())
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">
                                        <button type="submit" class="btn btn-warning {{$id == 0 ? 'disabled' : ''}}" >
                                            <i class="fa-solid fa-seedling fa-lg"></i>
                                        </button>    
                                    
                                    </li>
                                @endif
                                </ul>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Add Modal-->
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal');
@endsection

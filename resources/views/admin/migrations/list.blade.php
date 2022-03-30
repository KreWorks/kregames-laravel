@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Migrations lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton">
                        Hiányzó migration-ök futtatása
                    </button>
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
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.create') }}" method="POST">
                                            <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                                            <button type="submit" class="btn btn-success" >
                                                <i class="fa fa-arrow-up fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.migrations.create') }}" method="POST">
                                            <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                                            <button type="submit" class="btn btn-danger" >
                                                <i class="fa fa-arrow-down fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
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

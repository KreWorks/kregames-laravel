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
                        <tr>
                            <td class="align-middle">{{$datas[$index]->id}}</td>
                            <td class="align-middle">{{$datas[$index]->migration}}</td>
                            <td class="align-middle">{{$datas[$index]->helperClassName}}</td>
                            <td class="align-middle">{{$datas[$index]->batch}}</td>

                            <td class="align-middle">
                                <ul class="list-inline" style="margin-bottom:0px;">
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.'.$route.'.edit', $datas[$index]->id) }}" method="GET">
                                            <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                                            <button type="submit" class="btn btn-primary" >
                                                <svg class="card__icon--delete">
                                                    <use xlink:href="/apa/img/icons.svg#icon-edit"></use>
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="btn btn-danger"
                                            data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$route.'.destroy', $datas[$index]->id) }}', '{{$datas[$index]->deleteString}}', '{{$redirectUrl}}')">
                                            <svg class="card__icon--delete">
                                                <use xlink:href="/apa/img/icons.svg#icon-trash-2"></use>
                                            </svg>
                                        </div>
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

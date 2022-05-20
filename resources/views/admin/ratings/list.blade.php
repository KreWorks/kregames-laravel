@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Értékelési kategóriák lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('ratingForm')">
                        Új értékelési kategória hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Rating::$tableLabels;
            $redirectUrl = route('admin.ratings.index');
            ?>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Játék</th>
                        <th scope="col">Kategória</th>
                        <th scope="col">Helyezés</th>
                        <th scope="col">Átlag pontszám</th>
                        <th scope="col">Szavazatszám</th>
                        <th scope="col">Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td scope="col">{{$data->id}}</td>
                            <td scope="col">{{$data->game->name}}</td>
                            <td scope="col">{{$data->category->name}}</td>
                            <td scope="col">{{$data->rank}}</td>
                            <td scope="col">{{$data->average_point}}</td>
                            <td scope="col">{{$data->rating_count}}</td>
                            <td class="align-middle">
                                <ul class="list-inline" style="margin-bottom:0px;">
                                    <li class="list-inline-item">
                                        <form action="{{route('admin.'.$route.'.edit', $data->id) }}" method="GET">
                                            <input type="hidden" id="redirect_route" name="redirect_route" value="{{ $redirectUrl }}">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-edit fa-lg"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="btn btn-danger"
                                            data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{route('admin.'.$route.'.destroy', $data->id) }}', '{{$data->deleteString}}', '{{$redirectUrl}}')">
                                            <i class="fa fa-trash-can fa-lg"></i>
                                        </div>
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
    <!-- Add Modal-->
    <?php
    // Datas for adding game
    $name = 'rating'; 
    $displayName = 'Értékelési kategória';
    ?>
    @include('admin._modals.add_modal');
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal');
@endsection

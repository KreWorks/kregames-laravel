@extends('admin._layout.login_layout')

@section('content')

    <div class="col-md-9">
        <div class="card mb-3">
        <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">{{$entity->name}} szerkesztése</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-12 row-cols-md-12 mb-3">
                @include('admin.games.form')

                </div>
            </div>
        </div>

        <div class="card mb-3">
        <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">{{$entity->name}} linkeinek listája</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="add{{ucfirst($entity->name)}}Button"
                            onclick="openModal('links', 'link', 'create', '{{route('admin.games.store')}}')">
                        Új  link hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-12 row-cols-md-12 mb-3">
                    <?php 
                        $tableLabels = [
                            'name' => 'név', 
                            'linktype' => 'típus',
                            'link' => 'link'
                        ];
                        $datas=[];
                    ?>
                @include('admin._parts.table_list')

                </div>
            </div>
        </div>
    
    </div>
@endsection

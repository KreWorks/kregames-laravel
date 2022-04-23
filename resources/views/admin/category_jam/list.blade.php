@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Jam értékelési kategóriák lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('categoryJamForm')">
                        Új jam értékelési kategória hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\CategoryJam::$tableLabels;
            $redirectUrl = route('admin.category_jam.index');
            ?>
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    <!-- Add Modal-->
    <?php
    // Datas for adding game
    $name = 'categoryJam'; 
    $displayName = 'Értékelési kategória';
    ?>
    @include('admin._modals.add_modal');
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal');
@endsection

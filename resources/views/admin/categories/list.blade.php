@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Értékelési kategóriák lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('categoryForm')">
                        Új értékelési kategória hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Category::$tableLabels;
            $redirectUrl = route('admin.categories.index');
            ?>
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    <!-- Add Modal-->
    <?php
    // Datas for adding game
    $name = 'category'; 
    $displayName = 'Értékelési kategória';
    ?>
    @include('admin._modals.add_modal')
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal')
@endsection

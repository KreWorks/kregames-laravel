@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Játékok lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('gameForm')">
                        Új játék hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Game::$tableLabels;
            ?>
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    <!-- Add Modal-->
    <?php 
    $name = 'game'; 
    $displayName = 'Játék';
    $route = 'games';
    ?>
    @include('admin._modals.add_modal');
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal');
@endsection

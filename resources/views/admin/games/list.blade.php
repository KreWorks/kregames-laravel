@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Játékok lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('game', 'Játék', 'create', '{{route('admin.games.store')}}')">
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
    <!-- Add / Edit Modal-->
    <div class="modal fade" id="gameForm" tabindex="-1" aria-labelledby="gameFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="gameFormTitlelabel">Játék létrehozása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @include('admin.games.form')
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal')
@endsection
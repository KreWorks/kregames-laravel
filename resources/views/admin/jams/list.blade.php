@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Jamek lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addGameButton"
                            onclick="openModal('jam', 'Jam', 'create', '{{route('admin.jams.store')}}')">
                        Új jam hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Jam::$tableLabels;
            ?>
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    <!-- Add / Edit Modal-->
    <div class="modal fade" id="jamForm" tabindex="-1" aria-labelledby="jamFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="jamFormTitlelabel">Jam létrehozása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @include('admin.jams.form')
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal')
@endsection

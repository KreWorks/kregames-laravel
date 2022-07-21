@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Nyelvek lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addLanguageButton"
                            onclick="openModal('languageForm')">
                        Új nyelv hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Language::$tableLabels;
            $redirectUrl = route('admin.languages.index');
            ?>
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    <!-- Add / Edit Modal-->
    <div class="modal fade" id="languageForm" tabindex="-1" aria-labelledby="languageFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title" id="languageFormTitlelabel">Nyelv létrehozása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @include('admin.languages.form')
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    @include('admin._modals.delete_modal')
@endsection

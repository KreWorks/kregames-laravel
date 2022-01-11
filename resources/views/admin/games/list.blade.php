@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white p-3">
                Játékok
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="pagefilter" id="pagefilter" class="form-control"
                               placeholder="Filter Users ...">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="addJamButton"
                                data-bs-toggle="modal" data-bs-target="#addJam" >
                            Új jam
                        </button>
                    </div>
                </div>
            </div>
            @include('admin._parts.table_list')
        </div>
@endsection

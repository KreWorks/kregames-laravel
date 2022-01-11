@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Jam lista</span>
                    <button class="btn btn-warning col-md-3 float-right" type="button" id="addJamButton"
                            data-bs-toggle="modal" data-bs-target="#addJam" >
                        Új jam hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
            @include('admin._parts.table_list')
            </div>
        </div>
    </div>
@include('admin._modals.addjam')
@endsection

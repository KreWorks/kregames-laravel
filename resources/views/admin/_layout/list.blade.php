@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">{{ucfirst($hunName)}} lista</span>
                    <button class="btn btn-warning col-md-3 float-right" type="button" id="add{{ucfirst($name)}}Button"
                            data-bs-toggle="modal" data-bs-target="#{{$name}}Form" >
                        Új {{$hunName}} hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
                @include('admin._parts.table_list')
            </div>
        </div>
    </div>
    @include('admin.'.$route.'.modal')
@endsection

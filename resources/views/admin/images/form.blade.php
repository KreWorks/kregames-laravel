@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Kép {{$action}}</h4>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-6">
                        @if ($entity)
                        <form method="POST" action="{{ route($formAction, $entity->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @else 
                        <form method="POST" action="{{ route($formAction) }}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div class="form-group col-lg-12">
                                <label for="title" class="form-label">Cím</label>
                                <input class="form-control" type="text" id="title" name="title" value="{{ $entity ? $entity->title : '' }}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="alt_title" class="form-label">Kép alá szöveg</label>
                                <input class="form-control" type="text" id="alt_title" name="alt_title" value="{{ $entity ? $entity->alt_title : '' }}">
                            </div>
                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary col-6">Mentés</button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group col-lg-12">
                                <label for="icon" class="form-label">Kép ({{$entity->path}})</label>
                                <input class="form-control" type="file" id="icon" name="icon">
                            </div>
                            @if ($entity)
                            <div class="col-lg-12">
                                <img class="col-lg-6" src="/{{ $entity->path }}">
                            </div>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main content area end -->
@endsection
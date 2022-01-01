@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Link típus létrehozása</h4>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-6">
                        @if ($entity)
                        <form method="POST" action="{{ route($formAction, $entity->id) }}">
                            @method('PUT')
                        @else
                        <form method="POST" action="{{ route($formAction) }}">
                        @endif
                            @csrf
                            <div class="form-group col-lg-12">
                                <label for="name" class="col-form-label">Név</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->name : '' }}" id="name" name="name" >
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="hover_text" class="col-form-label">Hover szöveg</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->hover_text : '' }}" id="hover_text" name="hover_text">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="fontawesome" class="col-form-label">Font Awesome</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->fontawesome : '' }}" id="fontawesome" name="fontawesome">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="color" class="col-form-label">Szín</label>
                                <input class="form-control" type="color" value="{{ $entity ? $entity->color : '' }}" id="color" name="color" style="height:50px;width:100px">
                            </div>
                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary col-6">Mentés</button>
                            </div>
                           
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

@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Felhasználó {{$action}}</h4>
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
                                <label for="name" class="col-form-label">Név</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->name : '' }}" id="name" name="name">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="username" class="col-form-label">Felhaszánlónév</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->username : '' }}" id="username" name="username">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="email" class="col-form-label">Email</label>
                                <input class="form-control" type="email" value="{{ $entity ? $entity->email: '' }}" id="email" name="email">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="password" class="col-form-label">Jelszó</label>
                                <input class="form-control" type="password" value="" id="password" name="password">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="password_again" class="col-form-label">Jelszó ismét</label>
                                <input class="form-control" type="password" value="" id="password_again" name="password_again">
                            </div>

                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary col-6">Mentés</button>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group col-lg-12">
                                <label for="avatar" class="form-label">Avatár</label>
                                <input class="form-control" type="file" id="icon" name="avatar">
                            </div>
                            @if ($entity)
                            <div class="col-lg-12">
                                <img class="col-lg-3" src="/{{ $entity->__get('avatarPath') }}">
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
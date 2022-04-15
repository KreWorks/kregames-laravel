@extends('admin._layout.logout_layout')

@section('content')
<div class="offset-lg-5 col-lg-2" style="padding-top:150px;border-radius:15px;">
    <div class="card mb-3">
        <div class="card-header bg-primary text-white p-3">
            <b>KRÉ Games</b> - Belépés
        </div>
        <div class="card-body ">
        <form method="POST" action="{{ route('admin.authenticate') }}">
            @csrf
            <div class="login-form-body">
                <div class="form-group pt-3 pb-3">
                    <label for="email" class="form-label">Email cím</label>
                    <input type="text" id="email" class="form-control" name="email" required
                            autofocus>
                    @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                    <i class="fa fa-email"></i>
                </div>
                <div class="form-group pt-3 pb-3">
                    <label for="password">Jelszó</label>
                    <input type="password" id="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                    @endif
                    <i class="ti-lock"></i>
                </div>
                <div class="form-group mt-3 mb-5 pt-3">
                    <button class="btn btn-primary float-end" id="form_submit" type="submit">Belépés <i class="ti-arrow-right"></i></button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
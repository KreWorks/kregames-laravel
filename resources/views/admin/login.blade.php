@extends('admin._layout.logout_layout')

@section('content')
<!-- login area start -->
<div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form>
                    <div class="login-form-head">
                        <h4>Belépés</h4>
                        <p>Kapu az adatokhoz</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="email">Email cím</label>
                            <input type="email" id="email">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Jelszó</label>
                            <input type="password" id="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="remember_me">
                                    <label class="custom-control-label" for="remember_me">Emlékezz rám</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Elfelejtett jelszó</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Belépés <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Még nem regisztráltál?<a href="register.html">Regisztráció</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection

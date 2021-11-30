<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">KRÉ Games</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="#">{{ $controller }}</a></li>
                    <li><span>{{ $action }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="/{{ auth()->user() ? auth()->user()->avatarPath : '' }}" alt="avatar">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->user() ? auth()->user()->name : '' }}<i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.users.edit', auth()->user() ? auth()->user()->id : '') }}">Szerkesztés</a>
                    <a class="dropdown-item" href="{{ route('admin.users.edit', auth()->user() ? auth()->user()->id : '') }}">Új jelszó</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Kilépés</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('admin')}}">KRÉ Games</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Menu for data types -->
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                @foreach(get_menu() as $menuItem)
                    @if ($menuItem['route'] != 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{$menuItem['isActive']}}" href="{{route($menuItem['route'])}}">{{$menuItem['name']}}</a>
                    </li>
                    @endif
                @endforeach
            </ul>
            <!-- Menu for logged in user and logout -->
            <ul class="navbar-nav  mb-2 mb-md-0 navbar-right">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('admin.users.edit',1)}}">Welcome, KRÉ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.logout')}}">Kilépés</a>
                </li>
            </ul>
        </div>
    </div>
</div>

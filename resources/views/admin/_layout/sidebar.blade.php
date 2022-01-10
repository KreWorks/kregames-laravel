<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="text-center">
            <a href="{{ route('admin') }}"><h2>KRÉ Games</h2></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ $controller == 'Jam' ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-dashboard"></i><span>Jamek</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ $action == 'Lista' ? 'active' : ''}}">
                                <a href="{{ route('admin.jams.index') }}">Összes jam</a>
                            </li>
                            <li class="{{ $action == 'Létrehozás' ? 'active' : ''}}">
                                <a href="{{ route('admin.jams.create') }}">Új jam hozzáadása</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ $controller == 'Játék' ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-dashboard"></i><span>Játékok</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ $action == 'Lista' ? 'active' : ''}}">
                                <a href="{{ route('admin.games.index') }}">Összes játék</a>
                            </li>
                            <li class="{{ $action == 'Létrehozás' ? 'active' : ''}}">
                                <a href="{{ route('admin.games.create') }}">Új játék hozzáadása</a>
                            </li>
                        </ul>
                    </li>
                    <!--<li>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-dashboard"></i><span>Képek</span>
                        </a>
                        <ul class="collapse">
                            <li><a href="{{ route('admin.images.index') }}">Összes kép</a></li>
                            <li><a href="{{ route('admin.images.create') }}">Kép kategóriák</a></li>
                        </ul>
                    </li>-->
                    <li class="{{ $controller == 'Felhasználó' ? 'active' : ''}}">
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-dashboard"></i><span>Felhasználók</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ $action == 'Lista' ? 'active' : ''}}">
                                <a href="{{ route('admin.users.index') }}">Összes felhasználó</a>
                            </li>
                            <li class="{{ $action == 'Létrehozás' ? 'active' : ''}}">
                                <a href="{{ route('admin.users.create') }}">Új felhasználó hozzáadása</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->

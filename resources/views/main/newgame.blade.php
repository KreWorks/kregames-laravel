<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="KRÉ KRÉWorks" />
        <title>KRÉ Games - {{$game->name}}</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <link href="{{ asset('assets/font-awesome/css/all.css') }}" rel="stylesheet" />
        <!-- bootstrap -->
        <link href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
        <!-- css -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 text-center" style="border:2px solid black;">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Contact</a>
            </div>

                <div id="main">
                <button class="openbtn" onclick="openNav()">&#9776; Open Sidebar</button>
                </div>

            </div>
            <div class="col-lg-9" style="border:2px solid black;">
                tartalom
        </div>
        </div>
</div>
        <!-- Bootstrap core JS-->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }} "></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>

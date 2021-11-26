<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KRÉ Games - Portfolió</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">KRÉ Games</span>
                <span class="d-none d-lg-block">
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-1" src="{{asset('img/logo.png') }}" alt="..." />
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                @foreach ($games as $game)
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/{{$game->slug}}">{{ $game->name }}</a>
                    </li>
                @endforeach
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        KRÉ
                        <span class="text-primary">Games</span>
                    </h1>
                    <div class="subheading mb-5">
                        Szabadidejében játékokat készítő anya, programozó, gamer
                        <a href="mailto:kre@kregames.hu">kre@kregames.hu</a>
                    </div>
                    <div class="social-icons">
                        <a class="social-icon" href="https://www.linkedin.com/in/r%C3%A9ka-cs%C3%A1sz%C3%A1r-kozma-68045170/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="https://github.com/KreWorks"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="https://twitter.com/KreVagyok"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="https://twitter.com/KreGames"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="https://codemyui.com/3d-flip-image-content-slider/"><i class="fab fa-itch-io"></i></a>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            

            
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>

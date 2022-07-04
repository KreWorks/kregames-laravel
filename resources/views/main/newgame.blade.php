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
    <body>
        <div id="menu" class="sidebar">
            <button id="open-btn" class="openbtn" onclick="openNav()">&#9776;</button>
            <button id="close-btn" class="closebtn" onclick="closeNav()">&times;</button>

            <img src="{{asset('img/logo.png')}}" alt="Icon" class="img-fluid img-profile rounded-circle mx-auto" />
            <h1 class="text-center" id="page-name">KRÉ Games</h1>
            <hr/>
            <ul class="menu-list">
            @foreach($games as $item)
                <li class="menu-item">
                <a href="/refact/{{$item->slug}}" >
                <img src="/{{$item->icon->path}}" alt="{{$item->icon->alt}}" class="img-fluid game-menu-icon">
                <span class="menu-item-link">{{$item->name}}</span>
                </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div id="main" style="border:2px solid black;">
            <div class="row">
                <div class="col-lg-2 col-4 mb-5">
                    <img class="img-responsive" src="/{{$game->icon->path}}" alt="{{$game->icon->alt}}" style="width:100%" />
                </div> 
                <div class="col-lg-10 col-8 ">
                    <h1>{{$game->name}}</h1>
                    <h5>{{$game->releaseDate}}
                </div>    
            </div>
            <div class="row">
            <!-- Tabs navs -->
                <nav class="mb-3 col-lg-10">
                    <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">Leírás</a>    
                        <a class="nav-link" id="nav-jam-tab" data-bs-toggle="tab" href="#nav-jam" role="tab" aria-controls="nav-jam" aria-selected="true">Jam</a>
                        <a class="nav-link" id="nav-rating-tab" data-bs-toggle="tab" href="#nav-rating" role="tab" aria-controls="nav-rating" aria-selected="false">Értékelés</a>
                        <a class="nav-link" id="nav-images-tab" data-bs-toggle="tab" href="#nav-images" role="tab" aria-controls="nav-images" aria-selected="false">Képek</a>
                    </div>
                </nav>
                <!-- Tabs nav end -->
                <!-- Tab contents -->
                <div class="tab-content col-lg-10 col-md-10" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                        <p>A(z) <b>{{$game->name}}</b> játék a(z) {{$game->jam->name}} keretein belül készült {{$game->jam->start_date}} és {{$game->jam->end_date}} között. A jam témája <i>{{$game->jam->theme}}</i> volt. </p>
                    </div>
                    <div class="tab-pane fade" id="nav-jam" role="tabpanel" aria-labelledby="nav-jam-tab">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{$game->jam->icon}}">
                            </div>
                            <div class="col-lg-9">
                                <h1>{{$game->jam->name}}</h1>
                                <h5>{{$game->jam->start_date}} - {{$game->jam->end_date}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-rating" role="tabpanel" aria-labelledby="nav-rating-tab">
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Kategória</th>
                                    <th>Helyezés</th>
                                    <th>Pontszám</th>
                                    <th>Szavazatok</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($game->ratings as $rating)
                                <tr>
                                    <td>{{$rating->name}}</td>
                                    <td>{{$rating->pivot->rank}}</td>
                                    <td>{{$rating->pivot->average_point}}</td>
                                    <td>{{$rating->pivot->rating_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
                    @foreach($game->images as $image)
                            <img src="/{{$image->path}}" alt="{{$image->alt}}" class="img-responsive" />
                        @endforeach
                    </div>
                </div>
            <!-- Tab contents end -->
            </div>
        </div>



        <!-- Bootstrap core JS-->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }} "></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/main.js') }}"></script>
        <script>
            loadPage();
        </script>
    </body>
</html>

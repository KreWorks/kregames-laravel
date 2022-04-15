<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>KRÉ Games | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/apa/css/style.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/all.min.css" rel="stylesheet">
    
    
    <script src="/js/admin.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>    
</head>
<body>
@include('admin._layout.menu')
<!--
<header id="header" class="mb-3">
    <div class="container-fluid">
        <div class="row offset-md-3 col-md-9">
            <div class="col-md-10">
                <h1> <svg class="card__icon--white">
                        <use xlink:href="/apa/img/icons.svg#icon-home"></use>
                    </svg>
                    {{$controller}} <small>{{$action}}</small></h1>
            </div>
            <div class="col-md-2">
                <div class="dropdown create">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Create Content
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#addJam">Add Jam</a>
                        </li>
                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#addGame">Add Game</a>
                        </li>
                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#addUser">Add User</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
-->
<section id="main">
    <div class="container-fluid">
        <div class="row">
            @include('admin._layout.sidebar')
            @yield('content')
        </div>
    </div>
</section>
<footer id="footer" class="mt-4">
    <p>Copyright KreGames, &copy; 2022</p>
</footer>


<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

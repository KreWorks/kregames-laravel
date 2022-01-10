<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>KRÉ Games | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="/apa/css/bootstrap.css" rel="stylesheet">
    <link href="/apa/css/style.css" rel="stylesheet">
</head>
<body>
@include('admin._layout.menu')

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
<!-- Modals -->

<!-- Add Game Modal-->

<div class="modal fade" id="addGame" tabindex="-1" aria-labelledby="addGameLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameLabel">Add Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name">Name: </label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name">Slug: </label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="publishdate">Megjelenés dátuma </label>
                                <input type="date" name="publishdate" id="publishdate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="gamejam">Megjelenés dátuma </label>
                                <select name="gamejam" id="gamejam" class="form-select">
                                    <option value="Nincs Jam">Nincs Jam</option>
                                    <option value="1">Brackey's Game Jam #2</option>
                                    <option value="2">Pizza Jam</option>
                                    <option value="3">Ludum Dare 44</option>
                                    <option value="4">Brackey's Game Jam 2020.1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="gameicon" class="form-label">Ikon</label>
                                <input type="file" name="gameicon" id="gameicon" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Jam Modal-->

<div class="modal fade" id="addJam" tabindex="-1" aria-labelledby="addJamLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Jam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jamtitle" class="form-label">Név</label>
                        <input type="text" name="jamtitle" id="jamtitle" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamslug" class="form-label">Slug</label>
                        <input type="text" name="jamslug" id="jamslug" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jammembers" class="form-label">Indulók</label>
                        <input type="number" name="jammembers" id="jammembers" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamtheme" class="form-label">Téma</label>
                        <input type="text" name="jamtheme" id="jamtheme" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamstart" class="form-label">Kezdés</label>
                        <input type="date" name="jamstart" id="jamstart" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamend" class="form-label">Befejezés</label>
                        <input type="date" name="jamend" id="jamend" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamicon" class="form-label">Ikon</label>
                        <input type="file" name="jamicon" id="jamicon" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add User Modal-->

<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="useravatar" class="form-label">Avatar</label>
                        <input type="file" name="useravatar" id="useravatar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Add User" class="btn btn-primary ">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/apa/js/bootstrap.bundle.min.js"></script>
</body>

</html>

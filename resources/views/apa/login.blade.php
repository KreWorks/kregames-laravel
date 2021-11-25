<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>KRÉ Games · Belépés</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/"> -->

    <!-- Bootstrap core CSS -->
    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- <style>
    .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    @media (min-width: 768px) {
    .bd-placeholder-img-lg {
    font-size: 3.5rem;
    }
    }
    </style> -->


    <!-- Custom styles for this template -->
    <!-- <link href="dashboard.css" rel="stylesheet"> -->
</head>
<body>
    <div class="container-fluid">
        <main role="main" class="col-md-12 col-lg-12 px-md-12 ">
            <div class="d-flex justify-content-center align-self-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">KreGames | Login</h1>
            </div>
            <div class="container col-lg-6">
                <form class="form-signin" method="post" action="{{route('admin.authenticate') }}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Belépés</h1>
                <div class="form-group">
                    <label for="email" class="sr-only">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Jelszó:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                        
                <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                <p class="mt-5 mb-3 text-muted"> &copy;KRÉ Games 2020-2021</p>
                </form>
            </div>     
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>


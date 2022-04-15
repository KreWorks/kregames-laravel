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
    
<section id="main" style="height:calc(100vh - 94px);">
    @yield('content')
</section>

<footer id="footer" class="mt-4">
    <p>Copyright KreGames, &copy; 2022</p>
</footer>


<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

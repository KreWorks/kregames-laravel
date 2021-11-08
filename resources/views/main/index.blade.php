<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRÉ Games</title>
</head>
<body>
    <h1>SZIA</h1>    
    Játékok száma: {{ count($games) }}
    @foreach ($games as $game)
    <p>{{ $game->name }}</p>
     {{ count($game->images) }}
    @endforeach
</body>
</html>
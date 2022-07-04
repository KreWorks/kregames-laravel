<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body,
html {
  height: 100%;
  padding: 0;
  margin: 0;
}
.container {
  flex-direction: column;
}
.column {
  flex:1;
  margin-left:200px;
}
.column-a {
  background-color:Blue;
  height:30vh;
}
.column-b {
  background-color:Gray;
  height:70vh;
}
.sidebar {
  position:fixed;
  width:200px;
  background-color:Aqua;
  height:100%;
  }
</style>
</head>
<body>
  <div class="sidebar">
</div>
  <div class="container">
    <div class="column column-a">
      1
    </div>
    <div class="column column-b">
      2
    </div>
  </div>
</body>
</html>
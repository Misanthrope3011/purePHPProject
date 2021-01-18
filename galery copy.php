<!DOCTYPE html>
<html lang="pl">
<head>

  <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="stylesheet" href="css/lightbox.css" /> 
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="galeryStyle.css">
<script src="galerySlider.js"> </script>
<script  src="projectJS.js"></script>
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script src="js/bootstrap.min.js"></script>
 <link href="css/bootstrap.min.css" rel="stylesheet">

<script>

</script>

<title> Bootstrap cheat </title>
</head>
<body>
  <div class="row">
    <header>
      <div id="userDisplayData"> </div>
    <div id="show"> </div>
  <h1>
  Boxstats.pl
  </h1>
  
  </header>
  </div>
   <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark primary-color">
  
    <!-- Navbar brand -->
    <a class="navbar-brand" href="#">Menu:</a>
  
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">
  
      <!-- Links -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">Aktualnosci</a>  
            <span class="sr-only">(current)</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rejestracja.html"> Użytkownika </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.html">Dodawanie postu</a>
        </li>
  
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" href="#"> Inne </a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="galery.html">Galeria</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
  
      </ul>
      <!-- Links -->
  
     
    </div>
    <!-- Collapsible content -->
  
  </nav>
  <!--/.Navbar-->
      
      <div class="galeria">
  
        </div>

   <!--   <div class="inner"> <a href="galeriaSlider2.html" alt="galeria"> <img src="box.jpg"> </a> </div>
      <div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="box.jpg"> </a> </div>
      <div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="box.jpg"> </a> </div>
      <div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="box.jpg"> </a> </div>
      <div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="box.jpg"> </a> </div>
      <div class="inner"> <a href="galeriaSlider.html" alt="galeria"> <img src="box.jpg"> </a> </div>
     </div>
    -->
    
  <form id="form" enctype="multipart/form-data" method="post"> 
    
    <div class="form-group">
      <label for="titleForGalery">Tytuł galerii</label>
   <input type="text" class="form-control" id="titleForGalery" placeholder="tytuł">
    </div>
    <div class="form-group">
        <input type="file" class="form-control" id="image">
      </div>
      <div class="form-group">
          <button id="createNew" class="btn btn-primary" onlick="addToDatabase()"> Dodaj </button>
      </div>
  </form>

</body>
</html>

<?php 
  include_once("classes/UserDatabase.php");
  include_once("classes/Galery.php");
  include_once("Galery.php");
  include_once("sessionProcessing.php");

  $databaseConnection = new DatabaseConnection('localhost', 'root', '', 'klienci');
 $arrayOfIndexesAndThumbnails = Galery::selectImageForThumbnail($databaseConnection);
?>

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
  <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
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
      <li class="nav-item">
          <a class="nav-link" href="index.php">Aktualności</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rejestracja.php"> Użytkownika </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Dodawanie postu</a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item active">
          <a class="nav-link" href="galery.php"> Galeria</a>  
        </li>
  
      </ul>
      <!-- Links -->
  
     
    </div>
    <!-- Collapsible content -->
  
  </nav>
  <!--/.Navbar-->
      <div class="galeria">


      <?php
     for ($i = 0; $i < count($arrayOfIndexesAndThumbnails); $i++) { 
         echo '<div class="inner"> <a href="galerySlider.php?galery='.$i.'" alt="galeria"> <img src= galeria_zdjecia/'.$arrayOfIndexesAndThumbnails[$i] -> thumbnail . ' alt=zdjecie> </a> <h3>'. $arrayOfIndexesAndThumbnails[$i] -> title .'</h3> </div>';
    } ?>
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
        <input type="file" class="form-control" id="image" multiple>
      </div>
      <div class="form-group">
          <button id="createNew" class="btn btn-primary"> Dodaj </button>
      </div>
  </form>

  <div class = "container"> </div>

</body>
</html>

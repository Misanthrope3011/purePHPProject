<?php
session_start();
include_once("classes/User.php");
include_once("classes/UserDatabase.php");
include_once("sessionProcessing.php");
include_once("classes/Galery.php");
include_once("classes/Article.php");

$databaseConnection = new DatabaseConnection('localhost', 'root', '', 'klienci');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link rel="stylesheet" type="text/css" href="style.css">
<!-- <script src="projectJS.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script src="js/bootstrap.min.js"></script>
 <script src="ajax/delete.js"></script>
 <script src="projectJS.js"></script>
 
 <link href="css/bootstrap.min.css" rel="stylesheet">
<title> Bootstrap cheat </title>

</head>
<body>
<?php

if (isset($_POST['images']) && isset($_POST['titleOfGalery'])){
  

}


if (filter_input(INPUT_GET, "action") == "logout") {
  User::logout($databaseConnection);
}
if (isset($_POST['id'])){
  $id = $_POST['id'];
  $query = "delete from article where article_id = $id";
  $databaseConnection -> delete($query); ?>

<?php } ?>

  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v7.0"></script>


<div class="row">
  <header>
    <div id="userDisplayData"> 
    <?php     if (isset($_SESSION['currentUser'])) { ?>
<?php
  $currentUserData = unserialize($_SESSION['currentUser']);
  echo $currentUserData -> userName .'<br>'. $currentUserData -> id ?> 
  <br/> <a href = "rejestracja.php?action=logout">"<button id="logOut"> Wyloguj </button> </a>
<?php } else {

    echo '<a href="rejestracja.php?"> Zaloguj </a>';

} ?>
</div>
  <div id="show"> </div>
<h1>
Boxstats.pl
</h1>
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
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Aktualnosci</a>  
          <span class="sr-only">(current)</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rejestracja.php"> Użytkownika </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Dodawanie postu</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item">
        <a class="nav-link" href="galery.php">Galerie</a>
      </li>

    </ul>
    <!-- Links -->
  </div>
  <!-- Collapsible content -->

</nav>

<div class="row">
  
  <div class="col-sm-9">
<div id="articleContainer">

  <?php
    
    $numberOfArticles = Article::displayArticles($databaseConnection);

  ?>

</div>
</div>

<div class="col-sm-3">
<aside>
  <div class="inner">
    <div class="bs-example">
      <div class="asideHeader">
      <h2 class="mb-3">Najbliższe eventy</h2>
    </div>
      <dl class="row">
        
          <dt class="col-sm-3">12.06 </dt>
          <dd class="col-sm-9">Gala Wach Boxing Night- Mariusz Wach- Kevin Johnson - Pałac w Konarach</dd>
  
          <dt class="col-sm-3"> 27.06</dt>
          <dd class="col-sm-9">Lewis Riston - Kevin Vasquez - Newcastle, Utilita Arena</dd>
          
       
          <dt class="col-sm-3">4.07c</dt>
          <dd class="col-sm-9">Dillian White vs Alexander Powietkin - Manchester Arena, WBC Interim World Heavyweight Championship</dd>

      </dl>
  </div>
</div>
</aside>

</div>
</div>

</body>
</html>

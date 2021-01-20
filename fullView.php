<?php
include_once("classes/User.php");
include_once("classes/UserDatabase.php");
include_once("sessionProcessing.php");
include_once("classes/Galery.php");
include_once("classes/Article.php");
include_once("classes/Comment.php");

$currentDisplayedArticle = null;
$databaseConnection = new DatabaseConnection('localhost', 'root','', 'klienci');


    if (filter_input(INPUT_GET, "showFull")) {
        if(Article::checkIfArticleExists($databaseConnection, filter_input(INPUT_GET, "showFull"))) {
          $currentDisplayedArticle = filter_input(INPUT_GET, "showFull");
        } else {
          ?> <script type="text/javascript"> 
          $(function(){
              $("#form").hide();
              createPopup("Zły adres", "Strona o podanym odnosniku nie istnieje. Nastąpi przekierowanie do strony głównej");
          }); </script> <?php
        }
    } 
    if(filter_input(INPUT_POST, "submit")) {
      $currentUser = unserialize($_SESSION['currentUser']);
      $comment = new Comment($currentUser -> id, $currentDisplayedArticle, $_POST['comment']);
      $comment -> addCommentToDatabase($databaseConnection);
    }
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

if (filter_input(INPUT_GET, "action") == "logout") {
  User::logout($databaseConnection);
}
 ?>

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
        if ($currentDisplayedArticle !== NULL) {
          $arrayForArticle = $databaseConnection->select("SELECT * from article WHERE article_id = $currentDisplayedArticle");
          echo ' <div class="post"><h3>' .$arrayForArticle[0] ->title. ' </h3> <b> ' .$arrayForArticle[0] -> header. '</b> <br/> <div id="imageGrid"> ' .$arrayForArticle[0] -> content. '  ';?>
          <img src = "data:image/jpg;charset=utf8;base64,<?php echo base64_encode($arrayForArticle[0] -> image) ?> " />;  <?php
          echo '</div> </div>';
        }
  ?>
 
 <div class="form-group">
   <form id = "form" action = "fullView.php?showFull=<?php echo $currentDisplayedArticle ?>" method = "POST"> 
    <label for="comment" id ="comment"> Dodaj komentarz </label>
    <textarea class="form-control" id="comment" name ="comment" rows="3"></textarea>
    <input type="submit" class="btn btn-success" id="submit" name="submit" value = "Wyslij" />
  </form>
</div>

<div id="commentSection">
<div class="container">
<!--
    <div class="row">
        <div class="col-8">
            <div class="card card-white post">
                <div class="post-heading">
                    <div class="float-left meta">
                        <div class="title h5">
                            <a href="#"><b>Ryan Haywood</b></a>
                            made a post.
                        </div>
                        <h6 class="text-muted time">1 minute ago</h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>Bootdey is a gallery of free snippets resources templates and utilities for bootstrap css hmtl js framework. Codes for developers and web designers</p>
                </div>
            </div>
        </div>
-->
      <?php $currentArticleComments = (Comment::getAllCommentsFromArticle($databaseConnection, $currentDisplayedArticle)); 
            $currentArticleComments = array_reverse($currentArticleComments);
            foreach($currentArticleComments as $comment) {
              echo '<div class="row"> <div class="col-8"> <div class="card card-white post"><div class="post-heading"> <div class="float-left meta">';
              echo '<div class="title h5">  <a href="#"><b>'.$comment -> userName. '</b></a> </div> </div>  <h6 class="text-muted time">' .$comment -> dateOfCreation.' </h6>';
              echo '</div> <div class="post-description">' .$comment -> commentContent . '</div></div> </div> <button class="btn btn-danger" onclick=delete_comment('.$comment -> commentID.')> x </button></div>';
            }
      ?>
</div>

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

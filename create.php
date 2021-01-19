
<?php 
include_once("classes/User.php");
include_once("classes/UserDatabase.php");
include_once("classes/Article.php");
include_once("sessionProcessing.php");

$databaseConnection = new DatabaseConnection('localhost', 'root', '', 'klienci');

if(filter_input(INPUT_GET, "editId")) {
    $articleId = intval(filter_input(INPUT_GET, "editId"));
    echo "SELECT * from article WHERE article_id= $articleId";
    $articleToEdition = $databaseConnection -> select("SELECT * from article WHERE article_id= $articleId");
    $articleTitle = addslashes($articleToEdition[0] -> title);
    $articleHeader = addslashes($articleToEdition[0] -> header);
    $articleContent = addslashes($articleToEdition[0] -> content);
    $imageContent = addslashes($articleToEdition[0] -> image);
  ?>
  <script>
    var articleTitle = "<?php echo $articleTitle?>";
    var articleHeader = "<?php echo $articleHeader ?>";
    var articleContent = "<?php echo $articleContent ?>";

    $(document).ready(function() {
      
      $("#setTitle").prop("value", articleTitle);
      $("#articleIntro").prop("value", articleHeader);
      $("#articleContent").prop("value", articleContent);

    });

  </script> 


  <?php
} 

if (isset($_POST['submitForm'])) {

  if (!empty($_FILES["image"]["name"])) {
    $filename = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($filename, PATHINFO_EXTENSION);  
    
    $allowTypes = array('jpg', 'jpeg', 'bnp', 'png');
      if (in_array($fileType, $allowTypes)) {
        $image = $_FILES["image"]["tmp_name"];
        $imageContent = addslashes(file_get_contents($image));
    }
  }

  $userData = unserialize($_SESSION['currentUser']);
  $article = new Article(addslashes($_POST['title']), addslashes($_POST['header']), addslashes($_POST['content']), $userData -> id, $imageContent);

    if(filter_input(INPUT_GET, "editId")){
        $article -> updateArticle($databaseConnection, $articleId);
    } else {
        $article -> addArticleToDatabase($databaseConnection);
        header('Location: create.php');
    }

  // while ($result = fetchassoc())
  //< img scr = "data:image/jpg;charset=utf8;base64 <?php echo base64_encode($_ROW['image]);
}
?> 

 <!DOCTYPE html>
  <html lang="pl">
  <head>
    <meta charset="UTF-8">
  <script src=
  "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style2.css" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="projectJS.js"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/bootstrap.min.css" rel="stylesheet">
  <title> Bootstrap cheat </title>
  </head>
  <body>
  
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
            <a class="nav-link" href="index.php"> Aktualności</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rejestracja.php"> Użytkownika </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="create.php">Dodawanie postu</a>  
            <span class="sr-only">(current)</span>
          </li>
    
          <li class="nav-item">
            <a class="nav-link" href="galery.php"> Galerie</a>
          </li>
    
        </ul>
        <!-- Links -->
    
       
      </div>
      <!-- Collapsible content -->
    
    </nav>
    <!--/.Navbar-->

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



  <h3 id="article"> Dodawanie wpisu: </h3>
        <div class="row">
<div class="col-sm-9">
        <form id="form" enctype="multipart/form-data" method="post">
            <div class="form-group">
              <label for="setTitle">Tytuł</label>
              <input type="text" class="form-control" id="setTitle" name="title" placeholder="tytuł">
            </div>
        
         <div class="form-group">
              <label for="articleIntro">Wstęp </label>
              <textarea class="form-control" id="articleIntro" name="header" placeholder="Wstęp" rows="3"  ></textarea>
            </div>
    
           <div class="form-group">
              <label for="articleContent">Treść</label>
              <textarea class="form-control" id="articleContent" name="content" placeholder="Treść" rows="6"></textarea>
            </div>
    
          <div class="form-group">
              <div class="form-group">
    Zdjęcie:            <input type="file" class="form-control" id="image" name="image">
                </div>
          </div>
            <div class="form-group">
              <button class="btn btn-dark" id="sendArticle2" name="submitForm"> Wyślij </button>
              </div>
          </form>    
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
          </aside>  </div>   
   </div>

</body>
</html>


<?php
  include_once "../classes/UserDatabase.php";
  include_once "../classes/Article.php";

  $databaseConnection = new DatabaseConnection("localhost", "root", "", "klienci");


  if (isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "delete from article where article_id = '$id'";
  } else if (isset($_POST['commentID'])) {
    $id = $_POST['commentID'];
    $query = "delete from comments where commentID = '$id'";
  }
  $databaseConnection -> delete($query);  
?>    
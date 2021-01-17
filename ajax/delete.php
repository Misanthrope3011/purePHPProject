
<?php
  include_once "../classes/UserDatabase.php";
  include_once "../classes/Article.php";

  
  $id = $_POST['id'];
  $databaseConnection = new DatabaseConnection("localhost", "root", "", "klienci");
  $query = "delete from article where article_id = '$id'";
  $databaseConnection -> delete($query);  
?>    
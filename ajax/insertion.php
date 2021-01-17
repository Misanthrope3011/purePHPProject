<?php
include_once("classes/Galery.php");
include_once("classes/UserDatabase.php");

$databaseConnection = new DatabaseConnection('localhost', 'root','','klienci');
$indexOfGalery = Galery::selectGaleryID($databaseConnection);
if($indexOfGalery != -1) {
    $image = new Image($_POST['titleOfGalery'], $_POST['images'], $indexOfGalery + 1);
}
else {
    $image = new Image($_POST['titleOfGalery'], $_POST['images'], 0);
}

$image -> addImagesToDatabase($databaseConnection);

?>
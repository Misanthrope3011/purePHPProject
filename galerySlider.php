

<!DOCTYPE html>
<html lang="pl">
<head>
 <meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="galery.css"> 
 <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script src="galerySlider.js"></script>
<script src="galery.js"></script>
<link rel="stylesheet" href="css/lightbox.css" /> 
<!--<link rel="stylesheet" type="text/css" href="style.css"> -->
<script src="projectJS.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<title> Bootstrap cheat </title>
</head>
<body>

    <ul id="galery"> 
        <?php 
        include_once("classes/UserDatabase.php");
        include_once("classes/Galery.php");
        $databaseConnection = new DatabaseConnection('localhost', 'root', '', 'klienci');

        if(isset($_GET['galery'])) {
            $array = (Galery::selectImagesByGaleryID($databaseConnection, intval($_GET['galery'])));
            for ($i = 0; $i < count($array); $i++) {
                 echo '<li> <div class="content"> <img src=galeria_zdjecia/'.$array[$i] -> image_URL.'> <h2> Zdjęcie'. ($i + 1) .'</h2></div></li>';
            } 
        } 
            ?>
    </ul>

        
</body>
</html>

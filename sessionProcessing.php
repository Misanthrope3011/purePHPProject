<head> <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="projectJS.js"></script> 
<meta charset="UTF-8"> </head>
<?php

session_start();

if (!isset($_SESSION['currentUser'])) {
 ?> <script> 
    $(function() {
            if($(location).attr('pathname') == '/testside/create.php') {
                $('h3').hide();
                $('#form').hide();
                setTimeout(function(){ window.location.replace("index.php");} , 3500);
            } 
           if ($(location).attr('pathname') == "/testside/galery.php") {
                $('#form').hide(); 
           } 
    });
    </script>
<?php } ?>         

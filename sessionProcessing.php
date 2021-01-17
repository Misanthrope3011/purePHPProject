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
if (!isset($_SESSION['currentUser'])) {
 ?> <script> 
    $(document).ready(function() {
        $(".nav-link").click(function (e) {
            if($(this).attr("href") == "create.php") {
                e.preventDefault();
                $(".modal-body").text( "Nie masz uprawnien do podglądu tej strony. Nastąpi przekierowanie do strony glownej");
                $(".modal-title").text( "Odmowa dostępu");
                $('#myModal').modal('show');
                setTimeout(function(){ window.location.replace("index.php");} , 1500);
            }
        });  
    });
    </script>
<?php } ?>         

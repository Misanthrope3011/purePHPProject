<?php
include_once ("classes/User.php");
include_once ("RegistrationFrom.php");
include_once ("classes/UserDatabase.php");
include_once ("sessionProcessing.php");


$databaseConnection = new DatabaseConnection("localhost", "root", "", "klienci");
$registrationForm = new RegistrationForm();


  if (filter_input(INPUT_GET, "action") == "logout") {
    User::logout($databaseConnection);
  }

  if (isset($_POST['submit'])) {
    $databaseConnection -> addUserToDatabase($registrationForm);
  }

  if (isset($_POST['login'])) {
      $var = $databaseConnection -> selectUser($_POST['username'], $_POST['password1'], 'users');
      if ($var > 0) {
        $databaseConnection ->delete("DELETE FROM logged_in_users WHERE userId = $var");
        $dateTime = new DateTime('NOW');
        $stringDate = $dateTime->format('Y-m-d H:i:s');
        $sessionId = session_id();
        $data = $databaseConnection ->selectUserData($var);
        $_SESSION['currentUser'] = serialize($data);
        $databaseConnection -> delete("DELETE FROM logged_in_users WHERE sessionId = '$sessionId'");
        $databaseConnection -> insert("INSERT INTO logged_in_users VALUES ('$sessionId', '$var', '$stringDate')");
    ?>
        <script>
          $(function() {
            $("#password, #username").css("border-color", "greenyellow");
            $(".modal-body").text( "Zalogowano pomyślnie. Nastapi przekierowanie do strony glownej");
            $(".modal-footer .btn").addClass('.btn-success').removeClass('.btn btn-secondary, .btn btn-danger');
            $('#myModal').modal('show');
             setTimeout(function(){ window.location.replace("index.php");
             }, 1500);
            }) 
        </script>
      <?php
    } else { ?>
      <script>
        $(document).ready(function() {
          $("#password, #username").css("border-color", "red");
          $(".modal-body").text( "Blędne dane lub użytkownik nie istnieje");
          $(".modal-footer .btn").addClass('btn-danger').removeClass('.btn btn-secondary, .btn btn-success');
          $('#myModal').modal('show');
        })
      </script> 
      <?php
    }
  }
  ?>
  <!DOCTYPE html>
<html lang="pl">
<head>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/additional-methods.js"> </script>
<script src="validate.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="projectJS.js"></script> 
<meta charset="UTF-8">

 <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title> Bootstrap cheat </title>
</head>
<body>


  <div class="row">
    <header>
    <div id="userDisplayData"> 
    <?php if (isset($_SESSION['currentUser'])) { ?>
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
          <a class="nav-link" href="index.php"> Aktualnosci </a>
          <span class="sr-only">(current)</span>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="rejestracja.php"> Użytkownika</a>  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Dodawanie postu</a>
        </li>
  
        <!-- Dropdown -->
        <li class="nav-item">
          <a class="nav-link" href="galery.php"> Galerie</a>
        </li>
  
      </ul>
      <!-- Links -->
  
     
    </div>
    <!-- Collapsible content -->
  
  </nav>
  <!--/.Navbar-->

<div class = "grid"> 
  <div class = "gridWrapper">
  <div class="container">
          <div id="login">
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
              <h3 class="text-center text-white pt-5"></h3>
              <div class="container">
                  <div id="login-row" class="row justify-content-center align-items-center">
                      <div id="login-column" class="col-md-6">
                          <div id="login-box" class="col-md-12">
                              <form id="login-form" class="form" method="post" action = "rejestracja.php">
                                  <h3 class="text-center text-info">Login</h3>
                                  <div class="form-group">
                                      <label for="username" class="text-info">Username:</label><br>
                                      <input type="text" name="username" id="username" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="password" class="text-info">Password:</label><br>
                                      <input type="password" name="password1" id="password" class="form-control" required>
                                  </div>
                                  <div class="col text-center">
                                  <button class="btn btn-primary" id="logIn" name = "login" > Zaloguj </button>
                                  </div>
                                </form>
                                
                                <div id="register-link" class="text-right">
                                  <a href="#register" class="text-info"> Nie masz konta? Zarejestruj się! </a>
                              </div>         
                  </div>
                <br/> <br/>
                  
                </div>
                      </div>
                  </div>
              </div>
          </div>
          
      <div id="register">
  <div class="container">
      <form id="registerForm" name="validate" method="post" action = "rejestracja.php">
  <h3> Formularz rejestracyjny </h3>      
      <div class="form-group">
            <label for="exampleInputEmail1">Adres email*</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1">
      </div>

          <div class="form-group">
              <label for="exampleInputEmail1">Data urodzenia </label>
              <input type="date" class="form-control" id="dateBirth" name="dateBirth"> 
          </div>
    
          <div class="form-group">
            <label for="nameAndSurname">Nickname* </label>
            <input type="text" class="form-control" name="nameAndSurname" id="nameAndSurname"  placeholder="nazwa@host">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Password*</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" >
          </div>
          <div class="form-check">
          <label> Ilość lat zainteroswania boksem: </label> <input type="range" name="ageInputName" id="ageInputId" value="1" min="1" max="100" oninput="ageOutputId.value = ageInputId.value">
            <output name="ageOutputName" id="ageOutputId">1</output>
          </div>
          
          Zainteresowania: <br/>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1"  value="Literatura"  >
            <label class="form-check-label" for="exampleCheck1"> Literatura <br/> </label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck2"  value="Sztuka" >
            <label class="form-check-label" for="exampleCheck1"> Sztuka <br/>  </label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck3"  value="Gore"  >
            <label class="form-check-label" for="exampleCheck1"> Gore <br/>  </label>
          </div>
          <br/> <br/>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck4" name="acceptPolicy" >
            <label class="form-check-label" for="exampleCheck1"> Akceptuje regulamin* </label>
          </div>
          <br/> 
          <button type="submit" id="formSubmit" name = "submit" class="btn btn-primary">Submit</button>
        </form>

      </div>
    </div>
 </div>
 <div class="gridWrapper">
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

 </div>

</div>
</body>
</html>



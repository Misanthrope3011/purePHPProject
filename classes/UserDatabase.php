<html> <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src ="request.js"> </script>
</head>
<body>

<div id ="container">

<?php

include_once "User.php";

class DatabaseConnection {
 private $mysqli; //uchwyt do BD
 public function __construct($serwer, $user, $pass, $baza) {
   $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
 /* sprawdz połączenie */
  if ($this->mysqli->connect_errno) {
   printf("Nie udało sie połączenie z serwerem: %s\n",
   $this->mysqli->connect_error);
   exit();
  }
 /* zmien kodowanie na utf8 */
  if ($this->mysqli->set_charset("utf8")) {
  //udało sie zmienić kodowanie
  }
 } //koniec funkcji konstruktora
 function __destruct() {
  $this->mysqli->close();
 }

 static function getAllUsers($db, $pola) {

  $query = "SELECT * FROM users";
  $tresc = "";

 if ($result = $db->mysqli->query($query)) {
 $ilepol = count($pola); //ile pól
 $ile = $result->num_rows; //ile wierszy
 // pętla po wyniku zapytania $results
 $tresc.="<table border = 1><tbody>";
 $id;
 while ($row = $result->fetch_object()) { 
  $tresc .= "<tr>";
  for ($i = 0; $i < $ilepol; $i++) {
      $p = $pola[$i];
  if ($i == 0)
     $id = intval($row -> $p);
  $tresc.="<td>" . $row->$p . "</td>";
      }
 $tresc.="<td> <button type=submit name = usun class=id onclick = delete_data($id)> Usun </button> </td>";
 $tresc.="</tr>";
 }
 $tresc.="</table></tbody>";
 $result->close(); /* zwolnij pamięć */
 }
 return $tresc;
 }
 public function insert($sql) {
     if ($this->mysqli->query($sql) === TRUE) {
       echo 'Dodane';
         return true;
     } else {
       echo 'Nie dodane',  $this->mysqli ->error;
         return false;
     }
}

public function delete($sql){
  if ($this->mysqli->query($sql) === TRUE) {  
      return true;
  } else {
    echo 'Nie dodane',  $this->mysqli ->error;
      return false;
  }
 }

 public function getAllLoggedUsers() {

 }

function password_verify($passwd, $hash) {

  if ($passwd == $hash)
    return true;

  return false;  

}
 public function selectUser($login, $passwd, $tabela) {
  //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
  //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
  $id = -1;
  $sql = "SELECT * FROM $tabela WHERE userName='$login'";
  if ($result = $this->mysqli->query($sql)) {
  $ile = $result->num_rows;
  if ($ile == 1) {
  $row = $result->fetch_object();
  $hash = $row->passwd; //pobierz zahaszowane hasło użytkownika
  //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
  if (password_verify($passwd, $hash)) 
  $id = $row->id; //jeśli hasła się zgadzają - pobierz id użytkownika
  }
  }
  return $id; //id zalogowanego użytkownika(>0) lub -1
 }

 public function select($sql) {

  $stack = array();

    if ($result = $this->mysqli->query($sql)) {
      while ($value = ($result -> fetch_object())) {
      array_push($stack, $value);       
    }
  }
    return $stack;
 }
 public function selectUserData($id) {
  $sql = "SELECT * FROM users WHERE id = $id";

 if ($result = $this->mysqli->query($sql)) {

  $ile = $result->num_rows; //ile wierszy

  if ($ile == 1){
    $selectedUser = $result -> fetch_object();
    
    return $selectedUser;
  }
   return null;
  }
}
    function addUserToDatabase($registration){
        //validacja backendowa jak mi sie bedzie chcialo  

      $dane = new User( $_POST['nameAndSurname'],  $_POST['email'], $_POST['password'], $_POST['dateBirth']);
      $dane -> setStatus(User::STATUS_ADMIN);
      //pobierz dane z formularza, dokonaj ich walidacji
      //sformułuj zapytanie $sql typu insert np.:
        $sql = "INSERT into `users`() VALUES (NULL, '{$dane->getnickname()}', '{$dane->getEmail()}', '{$dane->getPassword()}', '{$dane->getBirthDate()}','{$dane->getStatus()}', '{$dane->getDate()}')"; 
     // $sql = "INSERT into `users` VALUES (NULL, {$dane->getUserName()}, {$dane->getFullName()}, {$dane->getEmail()},  {$dane->getPassword()},  {$dane->getStatus()}, {$dane->getDate()})"; 
    
       $this->insert($sql);
      
 /*     if ($dane !== null) {
      echo 'Pomyslnie zalozone konto';
      header("Location: index.php");
    }*/
  }
  

 /**
  * Get the value of mysqli
  */ 
 public function getMysqli()
 {
  return $this->mysqli;
 }
} //koniec klasy Baza
?>
</div>
</body>
</html>
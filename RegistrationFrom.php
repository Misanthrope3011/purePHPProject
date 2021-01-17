<?php
class RegistrationForm {
 protected $user;

 function checkUser(){ // podobnie jak metoda validate z lab4
 $args = ['yyyy'];
 //przefiltruj dane:
 $dane = filter_input_array(INPUT_POST, $args);
 $errors = "";
    
 if ($errors === "") {
 //Dane poprawne – utwórz obiekt user
 //przefiltruj $this->user=new User($dane['nickname'], $dane['nameAndSurname'], $dane['email'],$dane['password']);
 } else {
 echo "<p>Błędne dane:$errors</p>";
 //$this->user = NULL;
 }

 //return $this->user;
 }
}

?>
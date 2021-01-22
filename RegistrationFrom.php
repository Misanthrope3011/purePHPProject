<?php
class RegistrationForm {
 protected $user;

 function checkUser(){ // podobnie jak metoda validate z lab4
    $args = array(
        'email' => FILTER_VALIDATE_EMAIL,
        'nameAndSurname' => ['filter' => FILTER_VALIDATE_REGEXP,
       'regexp' => "^[A-Za-z][A-Za-z0-9_!#$@#]{6,14}$"
           ],
       'password' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_REGEXP,
       'regexp' => "^(?=.*?[A-Z])[a-zA-Z0-9]{6,20}$"
           ],
        );
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
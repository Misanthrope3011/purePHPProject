<?php

class User {
    const STATUS_USER = "Uzytkownik";
    const STATUS_ADMIN = "Administrator";
    const STATUS_MODERATOR = "Moderator";
    protected $userName;
    protected $password;
    protected $nickname;
    protected $email;
    protected $date;
    protected $status;
    protected $dateBirth;
    //pozostale pola klasy:
    //...
    //metody klasy:
 
    function __construct($nickname, $email, $password, $dateBirth){
    //implementacja konstruktora
    $this-> status = User::STATUS_ADMIN;
    $this -> password = password_hash($password, PASSWORD_BCRYPT);
    $this -> email = $email;
    $this -> nickname = $nickname;
    $this -> status = User::STATUS_USER;
    $this -> date = new DateTime('NOW');
    $this -> dateBirth = date('Y-m-d', strtotime($dateBirth));    //nadać wartości pozostałym polom – zgodnie z parametrami
    }
  
static function logout($databaseConnection) {
    $sessionId = session_id();
    $result = $databaseConnection -> delete("DELETE from logged_in_users WHERE sessionId = '{$sessionId}'");
    if ( isset($_COOKIE[session_name()]) ) {
        setcookie(session_name(),'', time() - 42000, '/');
    }
    session_destroy();
}

static function selectNicknames($databaseConnection) {
    $sql = "SELECT userName FROM users";
    return $databaseConnection -> select($sql);
}

static function selectEmails($databaseConnection) {
    $sql = "SELECT email FROM users";
    return $databaseConnection -> select($sql);
}

    //zdefiniować pozostałe metody

    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

   


       function toArray(){

        $arr=[
        "nickname" => $this->userName,
        "nameAndSurname" => $this->nickname,
        "date" => $this->date,
        "email" => $this->email,
        "password" => $this->password,
        "status" => $this->status
        //. . .
        ];
        return $arr;
       }

       

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nickname
     */ 
    public function getnickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickname
     *
     * @return  self
     */ 
    public function setnickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date->format("Y-m-d H:i:s.u") ;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {

        $this -> date = $date;

        return $this;

    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setBirthDate($dateBirth)
    {
        $this->dateBirth = $dateBirth;
        return $this;
    }
    
    public function getBirthDate()
    {
        return $this->dateBirth;
    }
}


?>
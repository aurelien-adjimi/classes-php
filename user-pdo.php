<?php

$GLOBALS['PDO'] = true; 


class user {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct() {
        return $this;
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        $req = $GLOBALS['bdd']->prepare("INSERT INTO `utilisateurs`(`login`, `email`, `password`, `firstname`, `lastname`) VALUE ('$login','$email','$password','$firstname','$lastname')");
        $req->execute();
    
        $user = [$login, $password, $email, $firstname, $lastname];
        return $user;
    }

    public function connect($login, $password) {
        $req2 = $GLOBALS['bdd']->query("SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password'");
        $req2->execute();
        $res = $req2->fetchAll(PDO::FETCH_ASSOC);

        if ( count($res) ) {
            $this->login = $login;
            $this->password = $password;
            $this->email = $res[0]['email'];
            $this->firstname = $res[0]['firstname'];
            $this->lastname = $res[0]['lastname'];
            $this->id = $res[0]['id'];

            session_start();

            $_SESSION['login'] = $this->login;
            $_SESSION['email'] = $this->email;
            $_SESSION['firstname'] = $this->firstname;
            $_SESSION['lastname'] = $this->lastname;

        } 

    }

    public function disconnect() {
        session_start();
        session_destroy();
    }

    public function delete()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=classes','root','root');        
        $req3 = $bdd->prepare("DELETE FROM `utilisateurs` WHERE `login`='$this->_login'");
        $req3->execute();
        $this->disconnect();
    }

    public function update($login, $password, $email, $firstname, $lastname) {
        $req4 = $GLOBALS['bdd']->prepare("INSERT INTO `utilisateurs`(`login`, `email`, `password`, `firstname`, `lastname`) VALUE ('$login','$email','$password','$firstname','$lastname')");
        $req4->execute();

        $this->_login = $login;
        $this->_password = $password;
        $this->_email = $email;
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
    }

    public function isConnected() {
        $IsConnected = false;
        if(isset($_SESSION)) {
            $IsConnected = true;
            return $IsConnected;
        }
    }
    public function getAllInfos() {
        $All = [$this->login, $this->email, $this->password, $this->firstname, $this->lastname];
        return $All;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function getLastname() {
        return $this->lastname;
    }
}

?>
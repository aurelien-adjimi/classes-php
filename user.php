<?php 

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
        $bdd = mysqli_connect("localhost", "root", "", "classes");
        $req = "INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')";
        return $req;
    }
    
    public function connect($login, $password) {
            $bdd = mysqli_connect("localhost", "root", "", "classes");
            $req2 = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE login='$login' AND password='$password'");
            $res = mysqli_fetch_all($req2, MYSQLI_ASSOC);

            if(count($res)) {
                $this->login = $res[0]['login'];
                $this->email = $res[0]['email'];
                $this->firstname = $res[0]['firstname'];
                $this->lastname = $res[0]['lastname'];

                session_start();

                $_SESSION['login'] = $this->login;
                $_SESSION['email'] = $this->email;
                $_SESSION['firstname'] = $this->firstname;
                $_SESSION['lastname'] = $this->lastname;
            }
    }
      
    public function disconnect() {
        if (isset($_SESSION)) {
            session_destroy();
               }
               
    }

    public function delete() {
        $bdd = mysqli_connect("localhost", "root", "", "classes");
        $id = $_SESSION['id'];
        $req3 = mysqli_query($bdd,"DELETE FROM utilisateurs WHERE id = '$id'" );
        $this -> disconnect();
    }

    public function update($login, $password, $email, $firstname, $lastname) {
        $bdd = mysqli_connect("localhost", "root", "", "classes");
        $req4 = mysqli_query($bdd, "UPDATE utilisateurs SET login = '$login', password = '$password', email = '$email', firstname = '$firstname', lastname = '$lastname'");

        $this->_login = $login;
        $this->_password = $password;
        $this->_email = $email;
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
    }

    public function isConnected() {
        $isConnected = false; 
        if (isset($_SESSION['login'])) {
            $isConnected = true;
            return $isConnected;
        }
    }
    public function getAllInfos() {
        $bdd = mysqli_connect("localhost", "root", "", "classes");
        $id = $_SESSION['id'];
        $req5 = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = '$id'");
        $array = mysqli_fetch_all($req5, MYSQLI_ASSOC);
        foreach ($req5 as $key => $value); 

        
    }
    public function getLogin($login){
            return $this -> $login;
    }
    public function getEmail($email) {
            return $this -> $email;
    }
    public function getFirstname($firstname) {
            return $this -> $firstname;
    }
    public function getLastname($lastname) {
            return $this -> $lastname;
    }
    }


?>
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
        $req = "INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')";
        return $req;
    }
    
    public function connect($login, $password) {
        if (isset($_SESSION)) {
            session_start();
        }
    }
      
    public function disconnect() {
        if (isset($_SESSION)) {
            session_destroy();
               }
               
    }

    public function delete() {
        $id = $_SESSION['id'];
        $req3 = "DELETE id FROM utilisateurs WHERE id = '$id'";
    }

    public function update($login, $password, $email, $firstname, $lastname) {
        $req4 = "UPDATE utilisateurs SET login = '$login', password = '$password', email = '$email', firstname = '$firstname', lastname = '$lastname'";
    }
    public function isConnected() {

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
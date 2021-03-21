<?php
include_once("models/uporabniki.php");
class uporabniki_controller{
    public function dodaj(){
        require_once("views/uporabniki/dodaj.php");
    }
      public function shrani() {
        Uporabnik::register($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"],
         $_POST["email"], $_POST["address"], $_POST["zip"], $_POST["phone"], "moski", $_POST["age"]);
  
      }

      public function index(){
        $uporabniki = Uporabnik::vsi();

      require_once('views/uporabniki/index.php');
    }

    public function uredi(){
        $uporabnik = Uporabnik::najdiEnega($_GET["id"]);

        require_once("views/uporabniki/uredi.php");
    }

    public function shraniurejen(){
        Uporabnik::posodobiuporabnika($_GET["id"], $_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"],
        $_POST["email"], $_POST["address"], $_POST["zip"], $_POST["phone"], "moski", $_POST["age"]);
    }

    public function loginform(){
        require_once("views/uporabniki/prijava.php");
    }

    public function login(){
        $user = Uporabnik::prijava($_POST["username"], $_POST["password"]);
        if($user != false){
            $_SESSION['USER_NAME'] = $user->username;
            $_SESSION['USER_ID'] = $user->id;
        }

        call('strani', 'domov');

    }

    public function logout(){
        session_unset();
        session_destroy();
        call('strani','domov');
    }
      
}

?>
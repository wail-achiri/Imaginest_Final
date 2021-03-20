<?php
session_start();
if (isset($_SESSION['user']) || isset($_SESSION['mail'])) {
    header("Location: home.php");
}
require_once("./db/connecta_db.php");
require_once("funcions.php");


if(isset($_GET["code"])){
    if(isset($_GET["mail"])){
      $mail_user = htmlspecialchars($_GET["mail"]);
    }else if(isset($_GET["user"])){
      $mail_user = htmlspecialchars($_GET["user"]);
    }
    $code = htmlspecialchars($_GET["code"]);
    
    $dades = array("codi" => $code, "mail_user"=> $mail_user);
    setcookie("parametres",json_encode($dades),time() + 60 * 30);
}
$errors = array();
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_COOKIE["parametres"])){
      if(isset($_POST["pwd_hidde_primer"]) && isset($_POST["pwd_hidde_segon"])){
        $pwd_primer=filter_input(INPUT_POST,"pwd_hidde_primer",FILTER_SANITIZE_SPECIAL_CHARS);
        $pwd_segon=filter_input(INPUT_POST,"pwd_hidde_segon",FILTER_SANITIZE_SPECIAL_CHARS);
        
        $dades = json_decode($_COOKIE["parametres"]);
        cambiarVariables($code,$mail_user,$dades); //NOTE OBTINDREM DE L'ARRAY DE DADES EL CODI I EL MAIL
        if(!empty($pwd_primer) || !empty($pwd_segon)){
            if($pwd_primer==$pwd_segon){ //NOTE COMPROBEM QUE SIGUIN IGUALS LAS CONTRASENYAS QUE VOL CANVIAR
              
              $existeixReset = obtenirExisteixReset($mail_user,$db);
              $caducitat = obtenirCaducitat($mail_user,$db);

              if($existeixReset && $caducitat){ //NOTE COMPROBEM SI EXISTEIX EL CODI I CORREO RESET I SI NO HA CADUCAT
                  actualitzarContra($db,$mail_user,$pwd_primer);
                  require_once("./mail/mailconfirmReset.php");
                  header("Location:index.php?reset");
              }else{
                  anularVerificacio($db,$mail_user);
                  $fatal = true;
              }
              setcookie("parametres", "", time() - 36000 ); //NOTE ELIMINAREM LA COOKIE
            }else{
              array_push($errors,"<b class='errors'>¡Las contrasenyas <strong class='error'>no coincideixen!</strong></b>");
            }
        }else{
          array_push($errors,"<b class='errors'>¡Els camps de password <strong class='error'>estan buits!</strong></b>");
        }
      }
   }
}
?>
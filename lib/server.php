<?php
session_start();

require_once("./db/connecta_db.php");
require_once("funcions.php");
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        
        if (isset($_POST["email_user_hidde"]) && isset($_POST["pwd_hidde"])) {
            if (!empty($_POST["email_user_hidde"]) || !empty($_POST["pwd_hidde"])) {
                $user_email = filter_input(INPUT_POST, "email_user_hidde", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "pwd_hidde", FILTER_SANITIZE_SPECIAL_CHARS);
                try {
                    $lineas = consultaActiu($user_email, $db);
                    if ($lineas) { //NOTE MIRARA SI L'USUARI ESTA ACTIU O NO
                        if (consultaPwd($user_email, $db, $password)) { //NOTE FUNCIO QUE COMPROBARA SI LA CONTRASENYA ES CORRECTA
                            $actualitzat = actualitzarTemps($user_email, $db);
                            if ($actualitzat) { //NOTE SI S'HA ACTUALITZAT CORRECTAMENT
                                session_start();
                                $dades = obtenirUserMail($db);
                                $dades->execute(array($user_email, $user_email));
                                foreach ($dades as $fila) {
                                    $_SESSION['mail'] = $fila['mail'];
                                    $_SESSION['user'] = $fila['username'];
                                    $_SESSION['idUser'] = $fila['idUser'];
                                }
                                header("Location: home.php");
                            } else {
                                array_push($errors, "<b class='errors'>¡ERROR INESPERAT!</b>");
                            }
                        } else {
                            array_push($errors, "<b class='errors'>¡L'usuari/mail o contrasenya són <strong class='error'>incorrectes!</strong></b>");
                        }
                    } else {
                        array_push($errors, "<b class='errors'>¡Aquest usuari/mail <strong class='error'>no esta registrat o activat!</strong></b>");
                    }
                } catch (PDOException $e) {
                    echo 'Error amb la BDs: ' . $e->getMessage();
                }
            } else {
                array_push($errors, "<b class='errors'>¡Un dels camps estan <strong class='error'>buits!</strong></b>");
            }
        }
    }


    if (isset($_POST['registre'])) {
        //NOTE filtrarem per si hi ha algún caracter especial
        $codi_hash = hash('sha256', rand());
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $cognom = filter_input(INPUT_POST, "cognom", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "contra", FILTER_SANITIZE_SPECIAL_CHARS);
        $clon_pwd = filter_input(INPUT_POST, "clon_pwd", FILTER_SANITIZE_SPECIAL_CHARS);
        $errors = array();
        $errors = comprobacioErrors($errors, $username, $email, $nom, $cognom, $password, $clon_pwd);
        if (count($errors) == 0) { //NOTE mirem que no tinguem cap error
            $password = password_hash($password, PASSWORD_DEFAULT); //NOTE convertirem la contrasenya en hash
            $lineas = consultarExisteix($username, $email, $db);
            if ($lineas) {
                array_push($errors, "<b class='errors'>¡L'username o email ja <strong class='error'>estan registrats!</strong></b>");
            } else {
                $inserit = consultaInserirRegistre($email, $username, $password, $nom, $cognom, $codi_hash, $db);
                if ($inserit) { //NOTE si s'ha inserit correctament
                    $ok = true; //NOTE variable que ens permetra mostrar el modal
                    require_once("./mail/mailsender.php");
                } else {
                    array_push($errors, "<b class='errors'>¡No s'ha pogut registrar correctament!</b>");
                }
            }
        }
    }
} else {
    if (isset($_SESSION['user']) || isset($_SESSION['mail'])) {
        header("Location: home.php");
    }
}
if (isset($_GET["noexist"])) {
    array_push($errors, "<b class='errors'>¡No es pot recuperar la contrasenya, perque no existeix  <strong class='error'>la compte!</strong></b>");
  }

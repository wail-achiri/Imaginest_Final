<?php
    session_start();
    if(!isset($_SESSION['user']) || !isset($_SESSION['mail'])){
        header("Location: index.php");
    }
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(),"",time()-3600,"/");
    header("location: index.php");

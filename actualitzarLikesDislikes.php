<?php
    session_start();
    require_once('./db/connecta_db.php');
    require_once('./lib/funcions.php');

    $idPhoto = $_POST['idPhoto'];
    $tipo = $_POST['tipo'];
    
    if($tipo=='like'){
        $existe = existeixLikeDislike($db,$idPhoto,$_SESSION["idUser"],'L','D');
        if($existe==0){
            inserirLike($db,$idPhoto,$_SESSION["idUser"],'L');
        }else{
            updateLike($db,$idPhoto,$_SESSION["idUser"],'L');
        }

    }else{
        $existe = existeixLikeDislike($db,$idPhoto,$_SESSION["idUser"],'L','D');
        if($existe==0){
            inserirDisLike($db,$idPhoto,$_SESSION["idUser"],'D');
        }else{
            updateDisLike($db,$idPhoto,$_SESSION["idUser"],'D');
        }
    }

  


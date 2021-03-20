<?php
    session_start();
    require_once('./db/connecta_db.php');
    require_once('./lib/funcions.php');

    $idPhoto = $_POST['idPhoto'];
    $urlPath = $_POST['urlPath'];
    
    $row = imgRandomDiferentAnt($db,$urlPath);
    $Likes = retornarLikes($db,$row['idPhoto']);
    $Dislikes = retornarDislikes($db,$row['idPhoto']);
    $rating = retornarRating($Likes,$Dislikes);
    $estatusLike = retornarEstatus($db,$row['idPhoto'],$_SESSION["idUser"]);
    
    $comentaris = construirComentari($db,$row['idPhoto']);
    $hashtags = construirHashtags($db,$row['idPhoto']);
    

    setcookie("ultima", $row["urlPath"], time() + 1800);
    $mdata= array(
        "idPhoto"=>$row['idPhoto'],
        "title"=>$row['title'],
        "username"=>$row["username"],
        "description"=>$row['description'],
        "urlPath"=>$row['urlPath'],
        "comentaris"=>$comentaris,
        "hashtags"=>$hashtags,
        "estatus"=>$estatusLike,
        "rating"=>$rating,
        "likes"=>$Likes,
        "dislikes"=>$Dislikes,
        "rating"=>$rating
    );

echo json_encode($mdata);


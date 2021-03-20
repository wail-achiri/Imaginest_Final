<?php
require_once("./db/connecta_db.php");
session_start();

$comment = $_POST['comment'];
$idPhoto = $_POST['idPhoto'];

$sql = "INSERT INTO comentarios (idPhoto,username,comentario) values(?,?,?)";
$consulta = $db->prepare($sql);
$consulta->execute(array($idPhoto,$_SESSION["user"],$comment));

if ($consulta) {

    $comentario = "
    <div class='comment'>
        <a class='usuario'>".$_SESSION["user"]." : </a><span class='comentario'>".$comment."</span>
    </div>";
    
    $mData=array('uno'=>$comentario);
    echo json_encode($mData);
}
?>
<?php
    require_once('../db/connecta_db.php');
    require_once('../lib/funcions.php');
    session_start();
    $mida = $_FILES["fichero"]["size"];
    $tipo = $_FILES["fichero"]["type"];
    $nom_fitxer = $_FILES["fichero"]["name"];
    $titol = filter_input(INPUT_POST,"titol",FILTER_SANITIZE_SPECIAL_CHARS);
    $descripcio = filter_input(INPUT_POST,"descripcio",FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST,"categoria",FILTER_SANITIZE_SPECIAL_CHARS);

  

    //Miro si la mida del fitxer és > 1MB
    if($mida > 1 * 1024 * 1024){
        echo "<br>Fitxer massa gran (>1MB)";
        return;
    }
    if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png"))) {
        echo '<div><b>Error. La extensió o el tamany dels arxius no es correcta.<br/>
        - Es permeten arxius .jpg, .png.</b></div>';
        return;
    }

    $archivo_hash = $nom_fitxer.rand();
    $archivo_hash = hash("SHA256",$archivo_hash);
    if(!empty($titol) && !empty($descripcio)){
        $patron = "/#[^\s#]*/i";
        $dir_subida = '../uploads/';
        $fichero_subido = $dir_subida.$archivo_hash;

        $descripcio_outHash = $descripcio;
        $descripcio_outHash = preg_replace($patron,'',$descripcio_outHash);

        if(move_uploaded_file($_FILES["fichero"]["tmp_name"],$fichero_subido)){
            insertarFoto($db,$_SESSION['idUser'],$archivo_hash,$descripcio_outHash,$titol,$categoria);
            
            $totalHashtags=preg_match_all($patron,$descripcio, $aCoincidencias);
            echo "<br><br>";
            echo $totalHashtags;
            if($totalHashtags>0){

                foreach($aCoincidencias[0] as $text){
                    $cadena[]=$text;
                }
                $idPhoto=obtenerIDPhoto($db,$archivo_hash);
                
                for($i=0;$i<count($cadena);$i++){
                    $total = existeixHashtags($db,$cadena[$i]);
                    if($total==0){
                      insertarHashtags($db,$cadena[$i]);
                    }
                    insertarHashtagsPub($db,$idPhoto["idPhoto"],$cadena[$i]);
                }
            }
            header("Location: ../slider.php?post");
        }
    }
?>
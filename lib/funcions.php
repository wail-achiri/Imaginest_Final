<?php

    //NOTE FUNCIONS INDEX.PHP

    function consultaActiu($mail_user,$db){
        $sql = 'SELECT * FROM users WHERE active = ? AND (mail= ? OR username = ?)';
        $preparada = $db->prepare($sql);
        $preparada->execute(array(1,$mail_user,$mail_user));
       
       return $preparada->fetchAll(PDO::FETCH_ASSOC); //NOTE retorna si hi ha alguna fila activa amb l'usuari o mail introduït
   }

   function consultaPwd($mail_user,$db,$pwd){
       $sql ="SELECT passHash FROM users WHERE mail= ? OR username = ?";
       $contra = $db->prepare($sql);
       $contra->execute(array($mail_user,$mail_user));
       foreach ($contra as $fila) {
           $pwdHash=$fila['passHash'];
       } 
       return password_verify($pwd,$pwdHash);
   }

   function actualitzarTemps($mail_user,$db){
       $sql = "UPDATE users SET lastSignIn = current_timestamp() where mail = ? or username = ?";
       $actualitzar = $db->prepare($sql);
       return $actualitzar->execute(array($mail_user,$mail_user)); //NOTE retornara si ha sigut actualitzat o no
   }

   function obtenirUserMail($db){
       $sql = "SELECT idUser,mail,username FROM users WHERE mail= ? or username = ?";
       $dades = $db->prepare($sql);
       return $dades; //Retornarem les dades preparades
   }

   function mostrarErrors($errors_mostrar){
       if(count($errors_mostrar)!=0){
          foreach($errors_mostrar as $value){
           echo $value;
           echo "<br>";
          }
       }    
   }

   //NOTE FUNCIONS REGISTER.PHP

   function comprobacioErrors($error,$username,$email,$nom,$cognom,$password,$clon_pwd){
    if(empty($username)){
      array_push($error,"<b class='errors'>¡El camp <strong class='error'>usuari</strong> esta buit!</b>");
    }
    if(empty($email)){
      array_push($error,"<b class='errors'>¡El camp <strong class='error'>correo</strong> esta buit!</b>");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      array_push($error,"<b class='errors'>¡El correo <strong class='error'>no es valid!</strong></b>");
    }
    if(empty($nom)){
      array_push($error,"<b class='errors'>¡El camp <strong class='error'>nom</strong> esta buit!</b>");
    }
    if(empty($cognom)){
      array_push($error,"<b class='errors'>¡El camp <strong class='error'>cognom</strong> esta buit!</b>");
    }
    if(empty($password)){
      array_push($error,"<b class='errors'>¡El camp <strong class='error'>contrasenya</strong> esta buit!</b>");
    }
    if(empty($clon_pwd)){
      array_push($error,"<b class='errors'>¡El camp repetir <strong class='error'>contrasenya</strong> esta buit!</b>");
    }
    if($password!=$clon_pwd){
      array_push($error,"<b class='errors'>¡Las contrasenyas <strong class='error'>no coincideixen!</strong></b>");
    }      
    return $error; //NOTE retornarem els errors que tinguem
  }

  
  function consultarExisteix($user,$mail,$db){
      $sql = "SELECT * FROM users WHERE mail= ? OR username= ?";
      $consulta = $db->prepare($sql);
      $consulta->execute(array($mail,$user));
      return $consulta->fetchAll(PDO::FETCH_ASSOC); //NOTE retornara las filas que ha trobat amb les dades
  }
  
  function consultaInserirRegistre($mail,$user,$pwd,$name,$lastname,$codi,$db){
      $sql = "INSERT INTO users(mail,username,passHash,userFirstName,userLastName,active,activationCode) VALUES (?,?,?,?,?,?,?)";
      $consulta = $db->prepare($sql);
      return $consulta->execute(array($mail,$user,$pwd,$name,$lastname,0,$codi)); //NOTE retornara si ha fet correctament o no el insert 
  }


  //NOTE FUNCIONS MAILCHECKACCOUNT.PHP

  function consultarMailCode($code,$mail,$db){
    $sql = "SELECT * FROM users where mail= ? and activationCode= ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($mail,$code));
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
    //NOTE retornara las filas que ha trobat amb les dades
}


function actualitzatActiveCode($mail,$db){
    $sql = "UPDATE users SET active = ?,activationDate= current_timestamp(), activationCode = ? where mail = ?";
    $actualitzar = $db->prepare($sql);
    return $actualitzar->execute(array(1,null,$mail));   
}


//NOTE FUNCIONS RESETPASSWORD.PHP

  //NOTE FUNCIOO QUE RETORNARA PER REFERENCIA ELS VALORS DE CADA VARIABLE
function cambiarVariables(&$codi,&$usuari,$dades){
    $codi=$dades->{'codi'};
    $usuari=$dades->{"mail_user"};
}


function obtenirExisteixReset($usuari,$db){
    $sql = "SELECT * FROM users WHERE resetPass = ? AND (mail= ? or username= ?) ";
    $preparada = $db->prepare($sql);
    $preparada->execute(array(1,$usuari,$usuari));
    return $preparada->fetchAll(PDO::FETCH_ASSOC);
}


function obtenirCaducitat($usuari,$db){
    $sql = "SELECT * FROM USERS WHERE now()<resetPassExpiry and (mail = ? or username = ?)";
    $preparada = $db->prepare($sql);
    $preparada->execute(array($usuari,$usuari));
    return $preparada->fetchAll(PDO::FETCH_ASSOC);
}


function anularVerificacio($db,$usuari){
    $sql = "UPDATE users SET resetPassCode = ?,resetPassExpiry = ?, activationCode = ?, resetPass = ? WHERE mail = ? OR username = ?";
    $actualitzar = $db->prepare($sql);
    $actualitzar->execute(array(null,null,null,$usuari,$usuari));
}

function actualitzarContra($db,$usuari,$pwd){
    
    $pwd_hash = password_hash($pwd,PASSWORD_DEFAULT);
    $sql = "UPDATE users SET passHash = ? WHERE mail = ? or username = ?";
    $actualitzar = $db->prepare($sql);
    $actualitzar->execute(array($pwd_hash,$usuari,$usuari));
}


//NOTE FUNCIONS RESETPASSWORDSEND.PHP

function actualitzarCodeExpPass($codi,$usuari,$db){
  $sql = "UPDATE USERS set  resetPassCode = ?, resetPass = ? , resetPassExpiry= DATE_ADD(now(), INTERVAL 30 MINUTE) where username = ? or mail = ?";
  $consulta = $db->prepare($sql);
  return $consulta->execute(array($codi,1,$usuari,$usuari));
}


//NOTE FUNCIONS QUE GESTIONAN TOT EL SISTEMA DE LIKES,DISLIKES I RATING

function retornarLikes($db,$idPhoto){
  $sql = "SELECT COUNT(*) as Likes FROM estatus where estatus = ? and idPhoto = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array('L',$idPhoto));
  $row=$consulta->fetch(PDO::FETCH_ASSOC);
  $count = $row["Likes"];
  return $count;
}

function retornarDislikes($db,$idPhoto){
  $sql = "SELECT COUNT(*) as Dislikes FROM estatus where estatus = ? and idPhoto = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array('D',$idPhoto));
  $row=$consulta->fetch(PDO::FETCH_ASSOC);
  $count = $row["Dislikes"];
  return $count;
}


function retornarRating($likes,$dislikes){
  $r=0;
  if(($likes+$dislikes)>0){
    $r=round($likes/($likes+$dislikes)*5);
  }
  $rating="";
    for($i=0;$i<5;$i++){
      if($i<$r){
          $rating.="<i class='fas fa-star mt-2 rating'></i>";
      }else{
        $rating.="<i class='far fa-star mt-2 rating'></i>";
      }

    }

  return $rating;
}

function retornarEstatus($db,$idPhoto,$idUser){
  $sql = "SELECT estatus from estatus where idPhoto = ? and idUser = ? LIMIT 1";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idPhoto,$idUser));
  $row=$consulta->fetch(PDO::FETCH_ASSOC);
  

  if(empty($row["estatus"])){
    $estatus='N';
  }else{
    $estatus = $row["estatus"];
  }
  return $estatus;
}

function existeixLikeDislike($db,$idPhoto,$idUser,$like,$dislike){
  $sql = "SELECT * FROM estatus where idPhoto= ? and idUser= ? and (estatus = ? or estatus = ?);";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idPhoto,$idUser,$like,$dislike));
  return $consulta->rowCount();

}

function inserirLike($db,$idPhoto,$idUser,$Like){
  $sql = "INSERT INTO estatus values (?,?,?)";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idPhoto,$idUser,$Like));
}

function inserirDisLike($db,$idPhoto,$idUser,$Dislike){
  $sql = "INSERT INTO estatus values (?,?,?)";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idPhoto,$idUser,$Dislike));
}

function updateLike($db,$idPhoto,$idUser,$Like){
  $sql = "UPDATE estatus set estatus = ? where idPhoto= ? and idUser= ? and estatus = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($Like,$idPhoto,$idUser,'D'));
}

function updateDisLike($db,$idPhoto,$idUser,$Dislike){
  $sql = "UPDATE estatus set estatus = ? where idPhoto= ? and idUser= ? and estatus = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($Dislike,$idPhoto,$idUser,'L'));
}


//NOTE FUNCIONS ENCARREGADES A LA GESTIO DE HASHTAGS

function construirHashtags($db,$idPhoto){

  $sql = "SELECT valueHashtag AS hash from hashtagsPub where idPhoto = ?";
  $hashtag = $db->prepare($sql);
  $hashtag->execute(array($idPhoto));

  $hashtags="";
 
  while($fila=$hashtag->fetch(PDO::FETCH_ASSOC)){
    $hashtags.= "<a href='#'>".$fila['hash']."</a>";
  }

  return $hashtags;
}

function existeixHashtags($db,$hashtag){
  $sql = "SELECT * from hashtags where valueHashtag = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($hashtag));
  return  $consulta->rowCount();
}

function insertarHashtagsPub($db,$idPhoto,$hashtag){
  $sql = "INSERT INTO hashtagsPub (idPhoto,valueHashtag) values (?,?)";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idPhoto,$hashtag));
}

function insertarHashtags($db,$hashtag){
  $sql = "INSERT INTO hashtags (valueHashtag) values (?)";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($hashtag));
}



//NOTE FUNCIONS ENCARREGADES DE LAS IMATGES

function imgRandomDiferentAnt($db,$anterior){
  $sql = "SELECT * FROM photos P INNER JOIN users U ON U.idUser = P.idUser  where urlPath != ? order by rand() LIMIT 1";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($anterior));
  return $consulta->fetch(PDO::FETCH_ASSOC);
}

function imgRandom($db){
  $sql = "SELECT * FROM photos p inner join users u on u.idUser = p.idUser ORDER BY rand() LIMIT 1"; // carga una imagen que sea diferente a la anterior
  $preparada = $db->prepare($sql);
  $preparada->execute();
  return $preparada->fetch(PDO::FETCH_ASSOC);
}

function existeixFotos($db){
  $sql = "SELECT COUNT(*) FROM photos";
  $consulta = $db->query($sql);
  $consulta->execute();
  return $consulta->fetch(PDO::FETCH_ASSOC);
}

function insertarFoto($db,$idUsuario,$urlPath,$descripcion,$titulo,$categoria){
  $sql = "INSERT INTO photos (idUser,urlPath,description,pubDate,title,categoria) values (?,?,?,now(),?,?)";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idUsuario,$urlPath,$descripcion,$titulo,$categoria));
}


function obtenerIDPhoto($db,$urlPath){
  $sql ="SELECT idPhoto FROM  photos WHERE urlPath=?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($urlPath));
  return $consulta->fetch(PDO::FETCH_ASSOC);
}

function existeixFotoUsuari($db,$idUser){
  $sql = "SELECT COUNT(*) FROM photos WHERE idUser = ?";
  $consulta = $db->prepare($sql);
  $consulta->execute(array($idUser));
  return $consulta->fetch(PDO::FETCH_ASSOC);
}


function mostrarFotosUsuari($db,$idUser){

  $sql ="SELECT P.idPhoto as idPhoto,P.urlPath as UrlPath,P.title as title,P.description as description,
  P.categoria as categoria,U.username as username FROM photos P INNER JOIN users U on P.idUser = U.idUser
  where P.idUser=?";

  $consulta = $db->prepare($sql);
  $consulta->execute(array($idUser));

  while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
    $fila[]=$row;
  }

  return $fila;
}

function mostrarFotoRecent($db){
  $sql = "SELECT * FROM photos p inner join users u on u.idUser = p.idUser where pubDate = (SELECT MAX(pubdate) from photos)";
  $preparada = $db->query($sql);
  return $preparada->fetch(PDO::FETCH_ASSOC);
}

function mostrarTotesLesFotos($db){
  $sql = "SELECT urlPath from photos";
  $preparada = $db->query($sql);
  while($row=$preparada->fetch(PDO::FETCH_ASSOC)){
    $fila[]=$row;
  }
  return $fila;
}

function mostrarUltimaFoto($db,$ultima){
  $sql = "SELECT * FROM photos p inner join users u on u.idUser = p.idUser where p.urlPath= ?"; // carga una imagen que sea diferente a la anterior
  $preparada = $db->prepare($sql);
  $preparada->execute(array($ultima));
  return $preparada->fetch(PDO::FETCH_ASSOC);
}

//NOTE FUNCIO ENCARREGADA DE CONSTRUIR ELS COMENTARIS

function construirComentari($db,$idPhoto){
  $sql = "SELECT * from comentarios where idPhoto = ?";
  $comentarios = $db->prepare($sql);
  $comentarios->execute(array($idPhoto));  

  $comentaris="";
  while($fila=$comentarios->fetch(PDO::FETCH_ASSOC)){
    $comentaris.="
    <div class='comment'>
      <a class='usuario'>".$fila['username'].": </a><span>".$fila['comentario']."</span>
    </div>";
  }
  return $comentaris;
}









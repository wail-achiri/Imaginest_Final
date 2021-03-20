<?php
  require_once("./lib/resetPwd.php");
  require_once("./lib/modal.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pàgina resetPassword.php que ens permetra resetjar la contrasenya">
    <meta name="author" content="Wail El Achiri Naimi i Miguel Zafra Moreno">
    <link rel="stylesheet" href="./style/loginreg.css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>Recupera Contrasenya</title>
</head>
<body > 
    <div id="login-wrap">
        <div id="login-image" class="login-image"></div>
        <div class="login-card">
          <div class="login-card-header">
            <img class="display-md" src="./img/logov2.png" width="300">
            <p class="text-muted"><?php 
              if(isset($errors)){
                mostrarErrors($errors);
              }
           ?></p>
          </div>
          <form onsubmit="return ocultarPwd()" class="login-card-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <div class="input-agrupat">
              <input id="input-password-primer" class="form-field" type="password" placeholder="Password">
              <input id="input-hidde-primer" type="hidden" class="login__input" name="pwd_hidde_primer">
              <i class="fas fa-envelope m-i"></i>
            </div>
            <div class="input-agrupat">
                <input id="input-password-segon" type="password" placeholder="Torna a escriure la Password"/>
                <input id="input-hidde-segon" type="hidden" name="pwd_hidde_segon">
                <i class="fas fa-envelope m-i"></i>
            </div>
            <div class="buto-agrupat">
              <button type="submit" vlaue="Submit" class="buto buto-primer">ACTUALITZAR</button>
            </div>
          </form>
          <div class="login-card-footer">
            <p class="text-muted">2021 Copyright &copy; IMAGINEST, wailmiguel.</p>
          </div>
        </div>
      </div>

        <?php 
        if(isset($fatal) && $fatal){
          echo $modal_error_reset;
          echo "<script src='./js/obrirModal.js'></script>";
        }
      ?>
  </body>
  <script src="./js/ocultar_correo_pwd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['mail'])) {
  header("Location: index.php");
}
require_once('./db/connecta_db.php');
require_once('./lib/funcions.php');
$contador = existeixFotos($db);
if($contador['COUNT(*)'] > 0){
  if (isset($_GET['post'])) {
    $row = mostrarFotoRecent($db);
    setcookie("ultima", $row["urlPath"], time() + 1800);
  } else if(isset($_COOKIE["ultima"])){
    $row = mostrarUltimaFoto($db,$_COOKIE["ultima"]);
  }else{
    $row = imgRandom($db);
    setcookie("ultima", $row["urlPath"], time() + 1800);
  }
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Pàgina slider.php on es motraran las imatges publicades per tots els usuaris">
  <meta name="author" content="Wail El Achiri Naimi i Miguel Zafra Moreno">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title>GALERIA GENERAL</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!--

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/slider.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="./img/logov2.png" width="200" height="50" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a class="nav-link" href="home.php">LA TEVA GALERIA</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="upload_file.php">PUJA LA TEVA FOTO</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="slider.php">GALERIA IMATGES</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                SORTIR
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"><?php echo $_SESSION["user"] ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Tancar Usuari</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <div class="page-heading about-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4 id="welcome">INTERACTUA</h4>
            <h2 id="welcome2" >COMENTA</h2>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="best-features about-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>GALERIA GENERAL D'IMATGES D'USUARIS</h2>
          </div>
        </div>
      </div>
    </div>
    <?php if($contador['COUNT(*)']==0){?>
    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Sembla que no es troben <em>cap fotos</em> pujada per usuaris<i class="fas fa-exclamation"></i></h4>
                  <p>Pots ser el primer en compartir fotos amb la gent afegint un comentari, valoració, fotos dels teus viatges ... Dóna-li al botó</p>
                </div>
                <div class="col-md-4">
                  <a href="upload_file.php" class="btn btn-primary">Pujar foto</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }else{ ?>
    <div class="row">
      <div class="col-md-12">
        <div class="wrapper">
          <div class="container">
            <article class="gallery-card rounded border border-primary">
              <div class="slider gallery-images">
                <div id="galeria" class="slider-items gallery-image">
                  <div class='item active gallery-image'>
                    <img id="<?php echo $row['idPhoto'] ?>" src="./uploads/<?php echo $row['urlPath'] ?>" class="gallery-image mostr_img" />
                  </div>
                </div>
                <button id="dislike" name="dislike" data-toggle="tooltip" data-placement="top" title="DISLIKE" class="right-slide"><i class="fa fa-angle-right arrow"></i></button>
                <button id="like" name="like" data-toggle="tooltip" data-placement="top" title="LIKE"  class="left-slide"><i class="fa fa-angle-left arrow"></i></button>
              </div>
              <?php
              $Likes = retornarLikes($db, $row['idPhoto']);
              $Dislikes = retornarDislikes($db, $row['idPhoto']);
              $rating = retornarRating($Likes, $Dislikes);
              ?>
              <div id="info" class="slider">
                <div class="slider-items gallery-info gallerys">
                  <div class="itemo activo">
                    <h2 class="gallery-title"><?php echo $row['title'] ?></h2>
                    <div class="gallery-author">
                      <a href="#" id="usuari"><?php echo $row["username"] ?></a>
                    </div>
                    <p id="rating"><?php echo $rating; ?></p>
                    <p class="gallery-descr">
                      <?php echo $row['description'] ?>
                    </p>
                    <div class="gallery-actions">
                      <span id="section_likes">
                        <i id="cora" class="far fa-heart"></i>
                        <span id="likes"><?php echo $Likes ?></span>
                      </span>
                      <span id="section_dislikes">
                        <i id="cora_break" class="fas fa-heart-broken"></i>
                        <span id="dislikes"><?php echo $Dislikes  ?></span>
                      </span>
                    </div>
                    <div class="gallery-tags">
                      <?php
                      $hashtags = construirHashtags($db, $row['idPhoto']);
                      echo $hashtags;
                      ?>
                    </div>
                    <hr />
                    <div id="gallery-com" class="gallery-comments">
                      <div class="comment-add">
                        <form id="form-comment" role="form">
                          <input id="comment-say" autocomplete="off" maxlength="60" placeholder="Comenta alguna cosa..">
                          <!-- <span class="chars-counter"><span id="chars-current">0</span>/60</span> -->
                        </form>
                      </div>
                      <div id="comments_much">
                        <?php
                        $comentarios = construirComentari($db, $row['idPhoto']);
                        echo $comentarios;
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
  </div>
  <div class="happy-clients">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Imatges recents</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div class="owl-clients owl-carousel">
            <?php
            if($contador['COUNT(*)']>0){
              $fila = mostrarTotesLesFotos($db);
              foreach($fila as $row){
            ?>
            <div class="client-item">
              <img src="./uploads/<?php echo $row['urlPath'] ?>" width="200" height="120" alt="1">
            </div>
            <?php }} ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p class="text-muted">2021 Copyright &copy; IMAGINEST, wailmiguel.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>

 


  <!-- Bootstrap core JavaScript -->
  <script src="src/jquery/jquery.min.js"></script>
  <script src="src/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Additional Scripts -->

  <script src="./js/sliderMove.js"></script>
  <script src="./js/vote_rateRandom.js"></script>
  <script src="./js/chargeComment.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
  <scr src="assets/js/slick.js"></scr>
  <scr src="assets/js/isotope.js"></scr>
  <script src="assets/js/accordions.js"></script>

</body>
<script>

</script>

</html>
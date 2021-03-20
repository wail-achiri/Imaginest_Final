<?php
require_once("./db/connecta_db.php");
require_once("./lib/funcions.php");
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['mail'])) {
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Pàgina home.php on es mostraran las imatges pujades per l'usuari">
  <meta name="author" content="Wail El Achiri Naimi i Miguel Zafra Moreno">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title>LA TEVA GALERIA</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
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
        <!-- <a class="navbar-brand" href="index.html"><h2>Sixteen <em>Clothing</em></h2></a> -->
        <a class="navbar-brand" href="#">
          <img src="./img/logov2.png" width="200" height="50" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">LA TEVA GALERIA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="upload_file.php">PUJA LA TEVA FOTO</a>
            </li>
            <li class="nav-item ">
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
  <div class="page-heading products-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4 id="welcome">BEVINGUT <?php echo $_SESSION["user"] ?></h4>
            <h2 id="welcome2">LA TEVA GALERIA</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $contador = existeixFotoUsuari($db, $_SESSION["idUser"]);
  if ($contador['COUNT(*)'] == 0) { ?>
  <div class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-md-8">
                <h4>Sembla que no tens <em>cap foto</em> pujada <i class="fas fa-exclamation"></i></h4>
                <p>Pots començar a compartir fotos amb la gent afegint un comentari, valorant, fotos dels teus viatges ... Dóna-li al botó</p>
              </div>
              <div class="col-md-4">
                <a href="upload_file.php" class="filled-button">Pujar foto</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }else{ ?>
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="filters">
            <ul>
              <li class="active" data-filter="*">Totes les categories</li>
              <li data-filter=".Esport">Esport</li>
              <li data-filter=".Ciutat">Ciutat</li>
              <li data-filter=".Personal">Personal</li>
              <li data-filter=".Art">Art</li>
              <li data-filter=".Natura">Natura</li>
            </ul>
          </div>
        </div>      
        <div class="col-md-12">
          <div class="filters-content">
            <div class="row grid">
            <?php
              $fila = mostrarFotosUsuari($db,$_SESSION["idUser"]);
              foreach($fila as $row){
            ?>
              <div class="col-lg-4 col-md-4 all <?php echo $row["categoria"] ?>">
                <div class="rounded border border-primary product-item">
                  <a href="#"><img src="uploads/<?php echo $row["UrlPath"] ?>" alt=""></a>
                  <div class="down-content">
                    <a href="#">
                      <h4><?php echo $row["title"] ?></h4>
                    </a>
                    <h6>@<?php echo $row["username"] ?></h6>
                    <p><?php echo $row["description"]  ?></p>
                    <?php
                      $likes=retornarLikes($db,$row["idPhoto"]);
                      $dislikes=retornarDislikes($db,$row["idPhoto"]);
                    ?>
                    <i class="fas fa-thumbs-up" style="font-size: 25px; color:#007FF5;"></i>
                    <?php echo $likes ?>
                    <i class="fas fa-thumbs-down" style="font-size: 25px;color:#007FF5"></i>
                    <?php echo $dislikes ?>
                  </div>
                </div>
              </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }?>


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

  <style>
    body{
      background-color: #F0F1F2;
    }
  </style>

  

  <!-- Bootstrap core JavaScript -->
  <script src="src/jquery/jquery.min.js"></script>
  <script src="src/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/slick.js"></script>
  <script src="assets/js/isotope.js"></script>

</body>
</html>
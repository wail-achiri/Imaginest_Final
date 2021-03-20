<?php
  session_start();
  if(!isset($_SESSION['user']) || !isset($_SESSION['mail'])){
  header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="ca">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title>PUBLICA LAS TEVAS IMATGES</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <!--


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/upload.css">
  
</head>


<script src="assets/js/preview.js"></script>

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
            <li class="nav-item ">
              <a class="nav-link" href="home.php">LA TEVA GALERIA</a>
            </li>
            <li class="nav-item active">
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
  <div class="page-heading about-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4 id="welcome3">COMPARTEIX</h4>
            <h2 id="welcome4">COMENTA</h2>
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
            <h2>Puja la teva foto</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-image">
            <!--<img src="assets/images/feature-image.jpg" alt="">-->
            <div class="preview">
              <h5 style="text-align: center;">Preview de la foto</em></h5>
              <br>
              <img class="preview rounded" id="file-ip-1-preview" src="./img/thumb.jpg" ondragstart="drag(event)">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <form action="./lib/pujarFoto.php" method="POST" enctype="multipart/form-data">
            <div class="shadow p-3 mb-5 bg-white border border-primary rounded">
            <h5 class="card-title">Puja la teva foto fent click</h5>
            <div class='form-group'>
                <h4>TÍTOL</h4>
                <div class="aks-form">
                  <label class="aks-form-label" for="titol">Breu títol sobre la imatge:</label>
                  <input type="text" name="titol" id="name" class="aks-input" placeholder="Playa soleada">
                </div>

                <h4>DESCRIPCIÓ</h4>
                <div class="aks-form">
                  <label class="aks-form-label">Escriu una descripció per a la teva imatge</label>
                  <textarea name="descripcio" class="aks-input" data-textarea-auto-height="" rows="4" placeholder="Veranito de pandemia mundial #covid #sol #playa"></textarea>
                </div>

                <h4 class="category">Selecciona una categoria per a la teva imatge:</h4>
                <div id="radios" class="mt-2">
                  <label for="Esport" class="material-icons">
                    <input type="radio" name="categoria" id="Esport" value="Esport" checked/>
                    <span>&#xe52f;</span>
                  </label>								
                  <label for="Ciutat" class="material-icons">
                    <input type="radio" name="categoria" id="Ciutat" value="Ciutat" />
                    <span>&#xe7f1;</span>
                  </label>
                  <label for="Personal" class="material-icons">
                    <input type="radio" name="categoria" id="Personal" value="Personal" />
                    <span>&#xe8d3;</span>
                  </label>
                  <label for="Art" class="material-icons">
                    <input type="radio" name="categoria" id="Art" value="Art" />
                    <span>&#xe43a;</span>
                  </label>
                  <label for="Natura" class="material-icons">
                    <input type="radio" name="categoria" id="Natura" value="Natura" />
                    <span>&#xe3f7;</span>
                  </label>
                </div>

              <div class="uploader mt-3">
                <input id="file-upload" type="file" name="fichero" onchange="showPreview(event);" accept="image/*" />

                <label for="file-upload" id="file-drag">
                  <img id="file-image" src="#" alt="Preview" class="hidden">
                  <div id="start">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <div>Selecciona la imatge que vols pujar</div>
                    <div id="notimage" class="hidden">Please select an image</div>
                    <span id="file-upload-btn" class="btn btn-primary">Imatge</span>
                  </div>
                  <div id="response" class="hidden">
                    <div id="messages"></div>
                  </div>
                </label>

              </div>

              <div class="aks-form mt-4">
                  <input type="submit" class="aks-input" value="ENVIA" />
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content" style="padding: 10px 0px;">
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
    <script src="assets/js/owl.js"></script>
    <scr src="assets/js/slick.js"></scr>
    <scr src="assets/js/isotope.js"></scr>
    <script src="assets/js/accordions.js"></script>
</body>
<script src="assets/js/upload.js"></script>
</html>

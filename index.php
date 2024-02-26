<!doctype html>
<html lang="es">

<head>
  <title>Proyecto</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./fonts/icomoon/style.css">
  <link rel="stylesheet" href="./css/owl.carousel.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/toast.css">
  <link rel="stylesheet" href="test/1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Style -->
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/listado.css">
  <link rel="stylesheet" href="./css/window.css">
</head>

<body>
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->

  <header class="site-navbar-wrap">
    <div class="site-navbar site-navbar-target js-sticky-header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-2">
            <h1 class="my-0 site-logo"><a href="./index.php"><img src="./img/sting.svg" alt="" height="40" /></a></h1>
          </div>
          <div class="col-10">
            <nav class="site-navigation text-right" role="navigation">
              <div class="container">
                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3 text-dark"></span></a></div>

                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                  <li><a href="#home-section" class="nav-link">Inicio</a></li>
                  <li><a href="#servicios" class="nav-link">Servicios</a></li>
                  <li class="has-children">
                    <a href="#" class="nav-link"><strong>Idioma</strong></a>
                    <ul class="dropdown arrow-top">
                      <li><a href="#" class="nav-link">Español</a></li>
                      <li><a href="#" class="nav-link">English</a></li>
                      <li><a href="#" class="nav-link">Portugues</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>


  <section class="espacio_eredado"></section>
  <div class="page-container">
    <div class="wrapper-1">
      <div class="toast-1 success-1">
        <div class="container-13">
          <i class="fa-solid fa-person-walking"></i>
        </div>
        <div class="container-23">
          <p>¡Éxito!</p>
          <p>Este es un mensaje de éxito</p>
        </div>
        <button>&times;</button>
      </div>
    </div>
  </div>

  <div class="container mt-5 text-center">
    <h1 class="nav_titulo mb-5 lineabajo">¿Qué lugar deseas encontrar?</h1>
    <div class="d-flex justify-content-center mt-4 valor_c" id="categoria">
      <a class="nav-link corrector_nav1" data-bs-toggle="collapse" href="listado.php">Todos los negocios</a>
      <span class="text-muted mx-3 m-division"> | </span>
    </div>
  </div>
  <div class="w-100 bg-azul reor " id="subcategoria">

  </div>

  <!-- BUSCADOR -->
  <div class="container mt-4 d-flex justify-content-center">
    <div class="input-group" style="max-width: 700px;">
      <input type="search" id="buscar" class="form-control" />
      <button type="button" id="btnBuscar" class="bus btn btn-primary">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </div>

  <div class="container mt-5">
    <div class="container">
      <div class="row">
        <label>
          Filtrar por <i class="bi bi-funnel-fill"></i>
        </label>
      </div>
      <div class="row pt-4 distritoc" style="max-width: 300px;">
        <label class="pr-3">Distrito: </label>
        <select class="form-select" aria-label="Selecciona un distrito" id="selectDistritos">
          <option selected value="">Selecciona</option>
          <!-- Agrega más opciones según sea necesario -->
        </select>
      </div>
    </div>
  </div>


  <style>
    #mapDiv {
      height: 800px;
      background-color: aqua;
    }
  </style>


  <div id="mapDiv" class="mt-5"></div>

  <!-- FOOTER CARRUSEL -->
  <div class="w-100 p-3 background_cote mt-4">
    <section class="container-920">
      <div class="container text-center my-3">
        <!-- IMAGENES -->
        <div class="owl-2-style">
          <div class="owl-carousel owl-2" id="carrusel">

          </div>
        </div>
      </div>
    </section>
  </div>

  <a href="https://wa.me/51962662710?text=Deseo más información" target=”_blank” class="whatsapp-btn">
    <i class="bi bi-whatsapp"></i>
  </a>
  <div class="cuadro-btn">Inicia con nosotros</div>

  <!-- Footer -->
  <footer id="footer" class="bg-footer">
    <div class="container mb-5">
      <div class="row">
        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light"><img src="./img/sting.svg" alt="" height="40"></h2>
          <ul class="list-unstyled text-light footer-link-list">
            <li>Creativos, Estratégicos <br />e Innovadores</li>
          </ul>
        </div>
        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light">Síguenos</h2>
          <ul class="list-unstyled text-light d-flex justify-content-left">
            <li class="pr-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon _facebook.svg" /></a></li>
            <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon _instagram.svg" /></a></li>
            <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon_logo_behance.svg" /></a></li>
            <li class="pl-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon_tiktok.svg" /></a></li>
          </ul>
        </div>
        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light">Contáctanos</h2>
          <ul class="list-unstyled text-light footer-link-list">
            <li>Lorem ipsum dolor sit am secta emy dipiscing, elit netus pharetra copy condimentum lacus.</li>
            <li class="py-3">
              <a class="text-decoration-none text-white" href="#">
                <img src="./img/buzon.svg" /> stingstudio.chincha@gmail.com
              </a>
            </li>
            <li>
              <a class="text-decoration-none text-white" href="#">
                <img src="./img/phone.svg" /> +51 907 233 783
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="w-100 bg-footer linen pt-3">
      <div class="container">
        <div class="row pie">
          <div class="col-12 py-3 text-center">
            <p class="text-light">
              &copy; Sting Studio 2024 | Creativos, Estratégicos e Innovadores
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/jquery.sticky.js"></script>
  <script src="./js//owl.carousel.min.js"></script>
  <script src="./js//main.js"></script>
  <script src="./js/subycat/cate.js"></script>
  <script src="./js/busqueda/busqueda.js"></script>
  <script src="./js/carrusel/carrusel.js"></script>
  <!-- Toastr script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyjyqgSwFgtNUj84wtqmcBLRQvY3W6Jho&libraries=places&callback=initMap"></script>
  <script src="./js/mapa/mapa.js"></script>


</body>

</html>
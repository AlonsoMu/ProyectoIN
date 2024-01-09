<!doctype html>
<html lang="es">
    <head>
        <title>Listado</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="../fonts/icomoon/style.css">
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

        <!-- Style -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/listado.css">
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
            <div class="site-navbar site-navbar-target js-sticky-header bg-light">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-2">
                  <h1 class="my-0 site-logo"><a href="index.html"><img src="../img/logo.png" alt="" height="40" /></a></h1>
                </div>
                <div class="col-10">
                  <nav class="site-navigation text-right" role="navigation">
                    <div class="container">
                      <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3 text-dark"></span></a></div>

                      <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                        <li class="active"><a href="#home-section" class="nav-link">inicio</a></li>
                        <li><a href="#servicios" class="nav-link">servicios</a></li>
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

        <section class="espacio_eredado">
        </section>
        <div class="container mt-5 text-center">
            <h1>¿Qué lugar deseas encontrar?</h1>
            <div class="d-flex justify-content-center mt-4 valor_c">
                <a class="nav-link corrector_nav" data-bs-toggle="collapse" href="#negocios">Todos</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link corrector_nav" data-bs-toggle="collapse" href="#hoteles">Hoteles</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link corrector_nav" data-bs-toggle="collapse" href="#farmacias">Farmacias</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link corrector_nav" data-bs-toggle="collapse" href="#restaurantes">Restaurantes</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link corrector_nav" data-bs-toggle="collapse" href="#bodegas">Bodegas</a>
            </div>
        </div>

        <div class="container mt-4 d-flex justify-content-center">
            <div class="input-group" style="max-width: 700px;">
                <input type="search" id="form1" class="form-control" />
                <button type="button" class="bus btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="container mt-3 d-flex justify-content-start">
            <div class="input-group my-5" style="max-width: 300px;">
                <select class="form-select" aria-label="Selecciona un distrito">
                    <option selected>Selecciona un distrito</option>
                    <option value="distrito1">Distrito 1</option>
                    <option value="distrito2">Distrito 2</option>
                    <option value="distrito3">Distrito 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                <button type="button" class="bus btn btn-primary">
                    <i class="bi bi-filter"></i> Filtrar
                </button>
            </div>
        </div>

        <!-- Tarjetas con información -->
        <div class="container mt-4">
            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/ComerJordan.jpg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Pollería</h5>
                        <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                            <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                        <a href="menu.php" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/GettyImages-1241089605.png" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Pollería</h5>
                        <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                            <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                        <a href="menu.php" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Agrega más tarjetas según sea necesario -->
            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/Ken-Buck.jpg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Pollería</h5>
                        <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                            <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                        <a href="menu.php" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/Rettig-Hearing.jpeg" alt="Imagen de la tarjeta">
                    <div>
                        <h5 class="card-title">Pollería</h5>
                            <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                                <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                            <a href="menu.php" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>



    
        <div class="w-100 p-3 bg-light mt-5">
        <section class="container-920">
        <div class="container text-center my-3">
            <!-- IMAGENES -->
            <div class="owl-2-style">
                <div class="owl-carousel owl-2">
                  <div class="media-29101">
                    <a href="#"><img src="../img/1.svg" alt="Image" class="img-fluid"></a>
                  </div>
                  <div class="media-29101">
                    <a href="#"><img src="../img/2.svg" alt="Image" class="img-fluid"></a>
                  </div>
                  <div class="media-29101">
                    <a href="#"><img src="../img/3.svg" alt="Image" class="img-fluid"></a>
                  </div>
                  <div class="media-29101">
                    <a href="#"><img src="../img/1.svg" alt="Image" class="img-fluid"></a>
                  </div>
                  <div class="media-29101">
                    <a href="#"><img src="../img/2.svg" alt="Image" class="img-fluid"></a>
                  </div>
                  <div class="media-29101">
                    <a href="#"><img src="../img/3.svg" alt="Image" class="img-fluid"></a>
                  </div>
                </div>
            </div>      
        </div>
        </section>
        </div>


    <a href="https://wa.me/1234567890?text=hello+123" target=”_blank” class="whatsapp-btn">
      <i class="bi bi-whatsapp"></i>
    </a>
    <div class="cuadro-btn">Inicia con nosotros</div>


    <!-- Footer -->
    <footer class="bg-dark" id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5 text-center">
                    <h2 class="h2 text-light pb-3 border-light">Soporte</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none text-white" href="#">Ayuda</a></li>
                        <li><a class="text-decoration-none text-white" href="#">Términos y condiciones</a></li>
                    </ul>
                </div>

                    <div class="col-md-4 pt-5 text-center">
                        <h2 class="h2 text-light pb-3 border-light">Contáctanos</h2>
                        <ul class="list-unstyled text-light footer-link-list">
                            <li>
                                <a class="text-decoration-none text-white" href="#">
                                    <i class="bi bi-envelope"></i> Info@hotmail.com
                                </a>
                            </li>
                            <li>
                                <a class="text-decoration-none text-white" href="#">
                                    <i class="bi bi-phone"></i> +51 985 752 963
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 pt-5 text-center">
                        <h2 class="h2 text-light pb-3 border-light">Redes sociales</h2>
                        <ul class="list-unstyled text-light d-flex justify-content-center">
                            <li class="mx-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-facebook"></i></a></li>
                            <li class="mx-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-instagram"></i></a></li>
                            <li class="mx-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-tiktok"></i></a></li>
                            <li><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-linkedin"></i></a></li>
                        </ul>
                    </div>

                
                    
                <div class="row pie">
                    <div class="col-12 py-3 text-center">
                        <div class="border-top border-light my-3"></div>
                        <p class="text-light">
                            &copy; 2023 Nombre - Todos los derechos reservados
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </footer>



        
        <!-- Bootstrap JavaScript Libraries -->
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

       

        <script src="../js/jquery.sticky.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/main.js"></script>

       
    </body>
</html>

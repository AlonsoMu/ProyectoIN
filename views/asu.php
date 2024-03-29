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
        <link rel="stylesheet" href="..//css/style.css">
        <link rel="stylesheet" href="..//css/listado.css">
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
              <h1 class="my-0 site-logo"><a href="index.html"><img src="../img/sting.svg" alt="" height="40" /></a></h1>
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3 text-dark"></span></a></div>

                  <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                    <li><a href="#home-section"   class="nav-link">Inicio</a></li>
                    <li><a href="#servicios"  class="nav-link" >Servicios</a></li>
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
            <h1 class="nav_titulo mb-5 lineabajo">¿Qué lugar deseas encontrar?</h1>
            <div class="d-flex justify-content-center mt-4 valor_c">
                <a class="nav-link corrector_nav1" data-bs-toggle="collapse" href="#negocios">Todos los negocios</a>
                    <span class="text-muted mx-3 m-division"> | </span>
                <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'hoteles')">Hoteles <i class="bi bi-chevron-down"></i></a>
                <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'farmacias')">Farmacias <i class="bi bi-chevron-down"></i></a>
                <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'restaurantes')">Restaurantes <i class="bi bi-chevron-down"></i></a>
                <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'bodegas')">Bodegas <i class="bi bi-chevron-down"></i></a>
            </div>
        </div>

        <div class="w-100 bg-azul reor">
            <div id="hoteles" class="pb-5 w-820 text-center nego_acti" style="display:none;">
                <span class="topright">&times</span>
                <div class="row pb-4">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                </div>
                <div class="row">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Criollos</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Tradicional</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Extranjeros</button></div>
                </div>
            </div>

            <div id="farmacias" class="pb-5 w-820 text-center nego_acti" style="display:none;">
                <span class="topright">&times</span>
                <div class="row pb-4">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Comida rapidas</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Otros</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Criollos</button></div>
                </div>
                <div class="row">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                </div>
            </div>

            <div id="restaurantes" class="pb-5 w-820 text-center nego_acti" style="display:none;">
                <span class="topright">&times</span>
                <div class="row pb-4">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                </div>
                <div class="row">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Mariscos</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Extranjeros</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Otros</button></div>
                </div>
            </div>

            <div id="bodegas" class="pb-5 w-820 text-center nego_acti" style="display:none;">
                <span class="topright">&times</span>
                <div class="row pb-4">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Tradicional</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Criollos</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Extranjeros</button></div>
                </div>
                <div class="row">
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                  <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
                </div>
            </div>
        </div>

        <div class="container mt-4 d-flex justify-content-center">
            <div class="input-group" style="max-width: 700px;">
                <input type="search" id="form1" class="form-control" placeholder="Buscar..." />
                <button type="button" class="bus btn btn-primary">
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
                <select class="form-select" aria-label="Selecciona un distrito">
                    <option selected>Selecciona</option>
                    <option value="distrito1">Distrito 1</option>
                    <option value="distrito2">Distrito 2</option>
                    <option value="distrito3">Distrito 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            </div>
        </div>

        <!-- Tarjetas con información -->
        <div class="container mt-5">
            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/negocio.svg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Lorem ipsum sit amet</h5>
                        <p class="card-text"><span>Distrito:</span> Sit amet consectetur<br>
                                             <span>Ubicación:</span> Sit amet consectetur<br>
                        <img src="../img/whatsapp_10.svg" class="wsp" /> 923456789</p>
                        <a href="menu.php" class="btn btn-primary vermas">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/negocio.svg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Lorem ipsum sit amet</h5>
                        <p class="card-text"><span>Distrito:</span> Sit amet consectetur<br>
                                             <span>Ubicación:</span> Sit amet consectetur<br>
                        <img src="../img/whatsapp_10.svg" class="wsp" /> 923456789</p>
                        <a href="menu.php" class="btn btn-primary vermas">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/negocio.svg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Lorem ipsum sit amet</h5>
                        <p class="card-text"><span>Distrito:</span> Sit amet consectetur<br>
                                             <span>Ubicación:</span> Sit amet consectetur<br>
                        <img src="../img/whatsapp_10.svg" class="wsp" /> 923456789</p>
                        <a href="menu.php" class="btn btn-primary vermas">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="card custom-card2">
                <div class="card-body d-flex align-items-center">
                    <img src="../img/negocio.svg" alt="Imagen de la tarjeta">
                    <div>
                    <h5 class="card-title">Lorem ipsum sit amet</h5>
                        <p class="card-text"><span>Distrito:</span> Sit amet consectetur<br>
                                             <span>Ubicación:</span> Sit amet consectetur<br>
                        <img src="../img/whatsapp_10.svg" class="wsp" /> 923456789</p>
                        <a href="menu.php" class="btn btn-primary vermas">Ver más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>


        </div>



    
        <div class="w-100 p-3 background_cote mt-5">
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
    <footer id="footer" class="bg-footer">
        <div class="container mb-5">
            <div class="row">

                <div class="col-md-4 pt-5 text-left">
                    <h2 class="h2 text-light pb-3 border-light"><img src="../img/sting.svg" alt="" height="40"></h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>Creativos, Estratégicos <br/>e Innovadores</li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5 text-left">
                    <h2 class="h2 text-light pb-3 border-light">Síguenos</h2>
                    <ul class="list-unstyled text-light d-flex justify-content-left">
                        <li class="pr-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon _facebook.svg" /></a></li>
                        <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon _instagram.svg" /></a></li>
                        <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon_logo_behance.svg" /></a></li>
                        <li class="pl-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon_tiktok.svg" /></a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5 text-left">
                    <h2 class="h2 text-light pb-3 border-light">Contáctanos</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>Lorem ipsum dolor sit am secta emy dipiscing, elit netus pharetra copy condimentum lacus.</li>
                        <li class="py-3">
                            <a class="text-decoration-none text-white" href="#">
                                <img src="../img/buzon.svg" /> stingstudio.chincha@gmail.com
                            </a>
                        </li>
                        <li>
                            <a class="text-decoration-none text-white" href="#">
                                <img src="../img/phone.svg" /> +51 907 233 783
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
        <script src="..//js/jquery-3.3.1.min.js"></script>
        <script src="..//js/popper.min.js"></script>
        <script src="..//js/bootstrap.min.js"></script>

       

        <script src="..//js/jquery.sticky.js"></script>
        <script src="..//js/owl.carousel.min.js"></script>
        <script src="..//js/main.js"></script>

       
    </body>
</html>

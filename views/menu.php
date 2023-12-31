<!DOCTYPE html>
<html lang="es">

<head>
    <title>Menu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">

    <style>
        /* Estilo adicional para aumentar el tamaño de las estrellas */
        .stars i {
            font-size: 1.5rem;
            margin-right: 5px; /* Ajusta el valor según sea necesario */
        }

        /* Ajuste de tamaño del card y sombra */
        .custom-card {
            max-width: 1200px;
            width: 100%;/* Hace que el card ocupe el ancho completo */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Agrega sombra */
            margin: 2rem auto; /* Centra el card horizontalmente con un margen superior */
            position: relative; /* Permite posicionar elementos relativos a este contenedor */
            overflow: hidden; /* Oculta el contenido que se desborda del contenedor */
           align-items: center;
        }

        /* Añade espaciado entre las filas en dispositivos pequeños */
        .custom-card .row {
            margin-bottom: 1rem;
        }

        /* Estilo para la lista de redes sociales */
        .social-list {
            list-style: none;
            padding: 0;
        }

        .social-list p {
            font-size: 1.25rem; /* Tamaño del texto */
            margin: 0; /* Elimina el margen predeterminado de los párrafos */
        }

        /* Estilo para la portada */
        .portada {
            width: 100%;
            height: 600px; /* Ajusta la altura según sea necesario */
            background-size: cover;
            background-position: center;
        }

        /* Estilo para el cuadro encima de la portada */
        .cuadro-encima,
        .cuadro-encima2 {
            position: absolute;
            top: 41%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
        }

        .cuadro-encima2 {
            top: 100px;
            background-color:rgba(0, 0, 0, .7);
            padding: 10px;
            border-radius: 5px;
            width: 70%;
            color:#FFF;
            max-width: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cuadro-encima2 p {
            margin: 0; /* Elimina el margen predeterminado del párrafo */
        }

        .cuadro-encima2 i {
            margin-right: 5px; /* Ajusta el espacio entre el ícono y el texto */
        }

        /* PAPI */
        @media only screen and (max-width: 767px){
            .cuadro-encima2{top:85px; width:50%}
            .cuadro-encima{width:100%;}
            .custom-card{border-radius:15px;}
            .card-title{text-align:center;}
            .stars{text-align:center;}
        }


    </style>
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

    <section class="portada" style="background-image: url('../img/Ken-Buck.jpg');">
        <div class="cuadro-encima2">
            <i class="bi bi-clock"></i>
            <p class="text-light">Hoy Abierto</p>
        </div>
        <div class="cuadro-encima">
            <!-- Contenido del cuadro encima de la portada -->
            <div class="container mt-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Primera sección con el título -->
                                <h3 class="card-title">Chifa Oriental</h3>
                            </div>
                            <div class="col-md-4">
                                <!-- Segunda sección con estrellas de valoración -->
                                <div class="stars">
                                    <!-- Estrellas de valoración -->
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <!-- Sección de imagen -->
                                <img src="../img/logo.png" class="img-fluid" alt="Imagen">
                            </div>
                            <div class="col-md-4">
                                <!-- Sección con lista de redes sociales -->
                                <div class="social-list">
                                    <p><i class="bi bi-facebook"></i> Facebook</p>
                                    <p><i class="bi bi-whatsapp"></i> WhatsApp</p>
                                    <p><i class="bi bi-instagram"></i> Instagram</p>
                                    <p><i class="bi bi-tiktok"></i> TikTok</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Sección con dirección aleatoria y icono de ubicación -->
                                <!-- Icono de ubicación -->
                                <p><i class="bi bi-geo-alt"></i>Dirección: Dirección Aleatoria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>

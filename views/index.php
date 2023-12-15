<!doctype html>
<html lang="es">
    <head>
        <title>Listado</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />

        <link rel="stylesheet" href="../css/style.css">

        

       

       <!-- Iconos de Bootstrap 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

        

         

    <body>
        <header>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                    <img src="../img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">    
                        Logo</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto me-5">  
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ES
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">EN</a></li>
                            <li><a class="dropdown-item" href="#">JP</a>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>

            
             
        

        </header>

        <div class="container mt-4 text-center">
            <h1>¿Qué lugar deseas encontrar?</h1>
            <div class="d-flex justify-content-center mt-4">
                <a class="nav-link me-2" data-bs-toggle="collapse" href="#negocios">Todos</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link me-2" data-bs-toggle="collapse" href="#hoteles">Hoteles</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link me-2 " data-bs-toggle="collapse" href="#farmacias">Farmacias</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link me-2" data-bs-toggle="collapse" href="#restaurantes">Restaurantes</a>
                    <span class="text-muted mx-3"> | </span>
                <a class="nav-link" data-bs-toggle="collapse" href="#bodegas">Bodegas</a>
            </div>
        </div>

        <div class="container mt-4 d-flex justify-content-center">
            <div class="input-group" style="max-width: 700px;">
                <input type="search" id="form1" class="form-control" />
                <button type="button" class="btn btn-primary">
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
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-filter"></i> Filtrar
                </button>
            </div>
        </div>

        <!-- Tarjetas con información -->
    <div class="container mt-4">
        <div class="card custom-card">
            <div class="card-body d-flex align-items-center">
                <img src="../img/ComerJordan.jpg" alt="Imagen de la tarjeta">
                <div>
                <h5 class="card-title">Pollería</h5>
                    <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                        <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                    <button class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body d-flex align-items-center">
                <img src="../img/GettyImages-1241089605.png" alt="Imagen de la tarjeta">
                <div>
                <h5 class="card-title">Pollería</h5>
                    <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                        <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                    <button class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <!-- Agrega más tarjetas según sea necesario -->
        <div class="card custom-card">
            <div class="card-body d-flex align-items-center">
                <img src="../img/Ken-Buck.jpg" alt="Imagen de la tarjeta">
                <div>
                <h5 class="card-title">Pollería</h5>
                    <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                        <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                    <button class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body d-flex align-items-center">
                <img src="../img/Rettig-Hearing.jpeg" alt="Imagen de la tarjeta">
                <div>
                <h5 class="card-title">Pollería</h5>
                    <p class="card-text">Distrito: Distrito 1<br>Ubicación: Calle 123<br>
                        <i class="bi bi-whatsapp whatsapp-icon"></i> 923456789</p>
                    <button class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>


    

  <div class="slider">
    <div class="slide-track">
        <div class="slide">
            <img src="../img/ComerJordan.jpg" alt="">
        </div>
        <div class="slide">
            <img src="../img/GettyImages-1241089605.png" alt="">
        </div>
        <div class="slide">
            <img src="../img/Ken-Buck.jpg" alt="">
        </div>
        <div class="slide">
            <img src="../img/Rettig-Hearing.jpeg" alt="">
        </div>
        <div class="slide">
            <img src="../img/ComerJordan.jpg" alt="">
        </div>
        <div class="slide">
            <img src="../img/GettyImages-1241089605.png" alt="">
        </div>
        <div class="slide">
            <img src="../img/Ken-Buck.jpg" alt="">
        </div>
        <div class="slide">
            <img src="../img/Rettig-Hearing.jpeg" alt="">
        </div>
    </div>
  </div>

    
        <!-- Swiper -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>

    


        
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        

        

       
    </body>
</html>

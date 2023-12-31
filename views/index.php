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

        <link rel="stylesheet" href="../css/listado.css">

        

       

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
                        <a href="menu.php" class="btn btn-primary">Ver más <i class="bi bi-arrow-right"></i></a>
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



    
        <div class="w-100 p-3 bg-light mt-5">
        <section class="container-920">
        <div class="container text-center my-3">
            <div class="row mx-auto my-auto justify-content-center">
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                        <div class="carousel-item">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                        <div class="carousel-item active">
                            <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/1.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/2.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div><div class="col-md-3">
                                <div class="card mx-3">
                                    <div class="card-img my-3">
                                        <img src="../img/3.svg" class="img-fluid">
                                    </div>
                                </div>
                            </div></div>
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>      
        </div>
        </section>
        </div>

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
                            <li class="me-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-facebook"></i></a></li>
                            <li class="me-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-instagram"></i></a></li>
                            <li class="me-3"><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-tiktok"></i></a></li>
                            <li><a class="text-decoration-none text-white fs-4" href="#"><i class="bi bi-linkedin"></i></a></li>
                        </ul>
                    </div>

                
                    
                <div class="row">
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

        

        <script type="text/javascript">
            let items = document.querySelectorAll('.carousel .carousel-item')

            items.forEach((el) => {
                const minPerSlide = 4
                let next = el.nextElementSibling
                for(var i=1; i<minPerSlide; i++) {
                    if (!next){
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })
        </script>

        

        

       
    </body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Menu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        /* Estilo adicional para aumentar el tamaño de las estrellas */
        .stars i {
            font-size: 1.5rem;
            margin-right: 5px; /* Ajusta el valor según sea necesario */
        }

        /* Estilo para alinear el texto y las estrellas al mismo nivel */
        .stars {
            display: flex;
            align-items: center;
        }

        /* Ajuste de tamaño del card y sombra */
        .custom-card {
            width: 55rem; /* Ajusta el valor según sea necesario */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); /* Agrega sombra */
            margin: 0 auto; /* Centra el card horizontalmente */
            margin-top: 2rem; /* Ajusta el margen superior según sea necesario */
        }

        /* Añade bordes a las columnas */
        .custom-card .col {
            border-right: 1px solid #ddd; /* Borde derecho entre las columnas */
            padding-right: 15px; /* Espaciado derecho entre las columnas */
        }

        /* Elimina el borde derecho de la última columna */
        .custom-card .col:last-child {
            border-right: none;
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
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../img/logo.png" alt="" width="50" height="30"
                        class="d-inline-block align-text-top">
                    Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

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
                    <div class="col">
                        <!-- Sección de imagen -->
                        <img src="../img/logo.png" class="img-fluid" alt="Imagen">
                    </div>
                    <div class="col">
                        <!-- Sección con lista de redes sociales -->
                        <div class="social-list">
                            <p><i class="bi bi-facebook"></i> Facebook</p>
                            <p><i class="bi bi-whatsapp"></i> WhatsApp</p>
                            <p><i class="bi bi-instagram"></i> Instagram</p>
                            <p><i class="bi bi-tiktok"></i> TikTok</p>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Sección con dirección aleatoria y icono de ubicación -->
                         <!-- Icono de ubicación -->
                        <p><i class="bi bi-geo-alt"></i>Dirección: Dirección Aleatoria</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>

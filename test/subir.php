<!DOCTYPE html>
<html lang="es">

<head>
  <title>Subir imágenes</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/sidebar.css">
  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../fonts/icomoon/style.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../css/toast.css">
  <!----===== Iconscout CSS ===== -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./subir.css">


</head>

<body>
  <div class="container mt-3">
    <form class="rounded-form " action="" autocomplete="off" id="form-galeria">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <!-- BUSQUEDA DE NEGOCIO ASOCIADO -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="negocio" class="form-label">Nombre del negocio</label>
                <div class="input-group">
                  <input type="tel" id="negocio" class="form-control rounded-input" placeholder="Buscar...">
                  <button class="btn btn-success rounded-button" type="button" id="buscar"><i class="bi bi-search"></i></button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3 rounded-container">
                <div id="resultadoBusqueda" class="mb-3">
                  <label for="resultado" class="form-label">Resultado de la búsqueda:</label>
                  <input type="text" id="resultado" class="form-control rounded-input" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <p class="mt-5">Tamaño máximo de archivo permitido para cargar: 4,00 GB</p>
            <p id="fileSizeInfo" class="mt-2"></p>
            <div class="image-upload-container mt-2">

              <label class="file-input-label" for="fileInput">Suelte los archivos para comenzar a cargarlos</label>
              <p>o</p>
              <input type="file" class="file-input" id="fileInput" multiple accept=".png, .jpg, .jpeg, .webp">
              <div id="imageUploadProgress" class="image-upload-progress">
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <span id="progressPercentage">0%</span> <!-- Nuevo: porcentaje -->
                  </div>

                </div>
                <small class="text-muted" id="uploadStatus">Selecciona una o varias imágenes para cargar.</small>
              </div>
            </div>
          </div>
          <div id="uploadSuccess"></div>
          <div class="row mt-4 separar">
            <div class="col-md-12">
            </div>
          </div>
        </div> <!-- FIN DEL CARD -->
        <div class="row mt-4 separar">
          <div class="col-md-12">
            <button class="btn btn-danger botones-container" type="button" id="cancelar">Cancelar</button>
            <button class="btn btn-primary botones-container" type="submit" id="guardar">Guardar</button>
          </div>
        </div>
        <br>
    </form> <!-- FIN DEL FORMULARIO-->
  </div> <!-- FIN DEL CONTAINER -->
  </div>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.sticky.js"></script>
  <script src="../js//owl.carousel.min.js"></script>
  <script src="../js//main.js"></script>
  <script src="./subir.js"></script>

</body>

</html>
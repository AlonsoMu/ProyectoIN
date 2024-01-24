<!DOCTYPE html>

<html lang="html">
  <head>
    <title>How to Upload Files with JavaScript</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./subir.css">
    <link rel="icon" href="../img/arrow_down.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
     
      <link rel="stylesheet" href="../fonts/icomoon/style.css">
      <link rel="stylesheet" href="../css/owl.carousel.min.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="../css/toast.css">
      <!----===== Iconscout CSS ===== -->
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </head>

  <body>
    <div id="app">
      <h1>Awesome JavaScript File Uploader 🦄</h1>
      <div id="dropArea">
        <div class="row">
          <!-- BUSQUEDA DE NEGOCIO ASOCIADO -->
          <div class="col-md-6">
            <label for="negocio" class="form-label">Nombre del negocio</label>
            <div class="input-group">
              <input type="tel" id="negocio" class="form-control" placeholder="Buscar...">
              <button class="btn btn-success" type="button" id="buscar">Buscar</button>
            </div>
          </div>
          <div class="col-md-6">
            <div id="resultadoBusqueda" class="mb-3">
              <label for="resultado" class="form-label">Resultado de la búsqueda:</label>
              <input type="text" id="resultado" class="form-control" readonly>
            </div>
          </div>
        </div>
        <form>
          <p>
            Drop files here<br><br><span class="bold">or</span>
          </p>
          <input name="file" multiple type="file" accept="image/webp, image/jpeg, image/png">
          <span class="bold">and</span>
          <button type="submit" disabled>Upload</button>
        </form>
      </div>

      <progress value="0" max="100"></progress>
      <p>
        <strong>Uploading status:</strong>
        <span id="statusMessage">🤷‍♂ Nothing's uploaded</span>
      </p>

      <p>
        <strong>Uploaded files:</strong>
        <span id="fileNum">0</span>
      </p>

      <ul id="fileListMetadata"></ul>
    </div>
    <script src="./subir.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js//owl.carousel.min.js"></script>
    <script src="../js//main.js"></script>

    <script>
      document.addEventListener("DOMContenLoaded", () =>{
        function $(id) {
          return document.querySelector(id);
        }

        function busqueda() {
          const parametros = new FormData();
          parametros.append("operacion", "buscarNegocio");
          parametros.append("negocio", $("#negocio").value);

          fetch(`../controllers/negocio.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            console.log("Respuesta de búsqueda:", datos);
            const resultadoInput = $("#resultado");
            resultadoInput.value = datos.idpersona + '' + datos.datos;
            //resultadoInput.value = datos.datos;

            $("#resultadoBusqueda").style.display = "block";
          })
          .catch(e => {
            console.error("Error en la búsqueda:", e);
          });
        }
        $("#buscar").addEventListener("click", busqueda);
      })
    </script>
  </body>  
</html>
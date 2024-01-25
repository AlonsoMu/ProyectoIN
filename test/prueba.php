<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- CSS -->
      <link rel="stylesheet" href="../css/sidebar.css">
      <!-- CSS -->
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

      <style>
    /* Estilos para el área de carga de imágenes */
    .image-upload-container {
      border: 3px dashed #D9D9D9;
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
    }

    .image-upload-progress {
      display: none;
      margin-top: 10px;
    }

    .progress-bar {
      height: 20px;
      background-color: #28a745;
    }

    .file-input-label {
      font-size: 14px;
      margin-bottom: 5px;
      display: block;
    }

    .file-input {
      width: 100%;
    }

    .text-muted {
      font-size: 12px;
    }
  </style>
    </head>
  <body>
    <div class="container mt-3">
      <form action="" autocomplete="off" id="form-galeria">
        <div class="card">
          <div class="card-body">          
            <div class="row">
              <!-- BUSQUEDA DE NEGOCIO ASOCIADO -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="negocio" class="form-label">Nombre del negocio</label>
                  <div class="input-group">
                    <input type="tel" id="negocio" class="form-control" placeholder="Buscar...">
                    <button class="btn btn-success" type="button" id="buscar">Buscar</button>
                  </div>
                </div>                
              </div>  
              <div class="col md-6">
                <div class="mb-3">
                  <div id="resultadoBusqueda" class="mb-3">
                    <label for="resultado" class="form-label">Resultado de la búsqueda:</label>
                    <input type="text" id="resultado" class="form-control" readonly>
                  </div>
                </div>
              </div>            
            </div>
            <div class="image-upload-container">
              <label class="file-input-label" for="fileInput">Cargar Imágenes</label> 
              <input type="file" class="file-input" id="fileInput" multiple>
              <div id="imageUploadProgress" class="image-upload-progress">
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted" id="uploadStatus">Selecciona una o varias imágenes para cargar.</small>
                <div id="uploadedFiles" style="display:none;">Archivos subidos:</div>
              </div>
            </div>
            <!-- <div id="uploadSuccess" style="display:none; color: green;">¡Éxito! Las imágenes se han cargado correctamente.</div> -->
            <div id="uploadSuccess"></div>
            <div class="row mt-3">
              <div class="col-md-6">
                <button class="btn btn-danger" type="button" id="cancelar">Cancelar</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
              </div>
            </div>
          </div> <!-- FIN DEL CARD -->
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

    <script>
      document.addEventListener("DOMContentLoaded",() => {
        function $(id){
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
            console.log("Respuesta de búsqueda completa:", datos);
  
            if (datos.length > 0 && datos[0].idnegocio !== undefined && datos[0].nombre !== undefined) {
              const resultadoInput = $("#resultado");
              resultadoInput.value = datos[0].idnegocio + '. ' + datos[0].nombre;
              $("#resultadoBusqueda").style.display = "block";
            } else {
              console.error("Los campos idnegocio y/o nombre no están presentes en la respuesta.");
            }
          })
          .catch(e => {
            console.error("Error en la búsqueda:", e);
          });
        }

  
        $("#buscar").addEventListener("click", busqueda);

        // Function to handle image upload
        function handleImageUpload() {
          const fileInput = $("#fileInput");
          const progressBar = $(".progress-bar");
          const uploadStatus = $("#uploadStatus");
          const uploadSuccess = $("#uploadSuccess");
          const uploadedFilesContainer = $("#uploadedFiles");

          const files = fileInput.files;
          const maxImageCount = 12; // Set the maximum image count
  
          if (files.length === 0) {
            alert("Selecciona al menos una imagen para cargar.");
            return;
          }
  
          if (files.length > maxImageCount) {
            alert(`Solo puedes subir hasta ${maxImageCount} imágenes.`);
            // Clear the file input
            $("#fileInput").value = "";
            return;
          }
  
          // Show progress bar
          $("#imageUploadProgress").style.display = "block";

          // Simulate an upload process
          let progress = 0;
          const interval = setInterval(() => {
            progress += 10;
            progressBar.style.width = `${progress}%`;
  
            if (progress >= 100) {
              clearInterval(interval);
              uploadStatus.innerHTML = "¡Éxito! Las imágenes se han cargado correctamente.";
              uploadSuccess.style.display = "block";
  
              // Display uploaded file names
              const fileNames = Array.from(files).map(file => file.name);
              uploadedFilesContainer.innerHTML = `Archivos subidos: ${fileNames.join(", ")}`;
              uploadedFilesContainer.style.display = "block";
            }
          }, 200);
        }
  
  
        // Attach the handleImageUpload function to the file input change event
        $("#fileInput").addEventListener("change", handleImageUpload);
  
        // Button click event for Cancel
        $("#cancelar").addEventListener("click", () => {
          // Reset the file input
          $("#fileInput").value = "";
  
          // Hide the progress bar and uploaded files display
          $("#imageUploadProgress").style.display = "none";
          $("#uploadedFiles").style.display = "none";

          // Reset the success message
          $("#uploadSuccess").innerHTML = "";
          $("#uploadSuccess").style.display = "none";
        });
        
  
        function validarFotos(){
  
          const fotos = $("#fileInput")
  
          if(fotos.files.length > 10){
  
            alert("Solo puedes elegir 10 fotos");
  
          }else{
            insertGaleria();
          }
        }
  
        function insertGaleria(){
  
          const parametros = new FormData();
          parametros.append("operacion","registrar");
          parametros.append("idnegocio",$("#resultado").value);
          console.log($("#resultado").value);
          const inputFotografia = $("#fileInput");
  
          const fotosSeleccionadas = inputFotografia.files;
  
          for(let i = 0; i < Math.min(10, fotosSeleccionadas.length); ++i){
            parametros.append("rutafoto[]",fotosSeleccionadas[i])
          }
  
          fetch(`../controllers/galeria.controller.php`,{
            method:"POST",
            body: parametros
          })
            .then(result => result.json())
            .then(data =>{
              alert("Se registrò correctamente");
            })
            .catch(e => {
              console.error(e);
            });
  
        }
  
        $("#form-galeria").addEventListener("submit", (event) => {
          event.preventDefault();
          validarFotos()
        });
      });
    </script>
  </body>
</html>
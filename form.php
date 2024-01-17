<!doctype html>
<html lang="es">

<head>
  <title>Registro</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
  <div class="container mt-3">
    <form action="" autocomplete="off" id="form-carrusel">
      <div class="card">
        <div class="card-header">
          <div>Registrar fotos</div>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="foto" class="form-label">Fotografía</label>
            <input type="file" class="form-control" id="foto" accept=".jpg">
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit" id="guardar">Guardar</button>
        </div>
      </div> <!-- FIN DEL CARD -->
    </form> <!-- FIN DEL FORMULARIO-->
  </div> <!-- FIN DEL CONTAINER -->
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function $(id){
        return document.querySelector(id);
      }

      function carrusel() {
        const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("foto", $("#foto").files[0]);

        fetch(`./controllers/carrusel.controller.php`, {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          if (datos.idcarrusel > 0) {
            alert(`Foto registrado con ID: ${datos.idcarrusel}`)
            $("#form-carrusel").reset();
          }
        })
        .catch(e => {
          console.error(e)
        });
      }

      
      $("#form-carrusel").addEventListener("submit", (event) =>{
        event.preventDefault(); // Stop al evento
        
        if(confirm("¿Está seguro de guardar?")){
          carrusel();
        }
      });


      
    });
  </script>
</body>  

</html>
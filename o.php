<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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
    </head>

    <body>
    <div class="container mt-3">
      <form action="" autocomplete="off" id="form-negocio">
        <div class="card">
          <div class="card-header">
            <div>Registro Negocio</div>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- DISTRITO -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="iddistrito" class="form-label">Distrito</label>
                  <select name="iddistrito" id="iddistrito" class="form-select" required>
                    <option value="">Selecciona</option> 
                  </select>
                </div> 
              </div>
              <!-- BUSQUEDA DE NEGOCIO ASOCIADO -->
              <div class="col-md-6">
                <label for="nombre_apellido" class="form-label">Dueño del negocio</label>
                <div class="input-group">
                  <input type="tel" id="nombre_apellido" class="form-control" placeholder="Buscar...">
                  <button class="btn btn-success" type="button" id="buscar">Buscar</button>
                </div>
                <div id="resultadoBusqueda" class="mb-3">
                  <label for="resultado" class="form-label">Resultado de la búsqueda:</label>
                  <input type="text" id="resultado" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- SUBCATEGORIA DEL NEGOCIO -->
              <div class="col md-6">
                <div class="mb-3">
                  <label for="idsubcategoria" class="form-label">Giro negocio</label>
                  <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
                    <option value="">Selecciona</option> 
                  </select>
                </div>  
              </div>
              <!-- RUC -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nroruc" class="form-label">RUC</label>
                  <input type="tel" class="form-control" id="nroruc">
                </div>
              </div>
            </div>
            <div class="row">
              <!-- NOMBRE COMERCIAL DEL NEGOCIO -->
              <div class="col md-6">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre comercial</label>
                  <input type="text" class="form-control" id="nombre">
                </div>
              </div>
              <!-- DESCRIPCION -->
              <div class="col md-6">
                <div class="mb-3">
                  <label for="descripcion" class="form-label">Información negocio</label>
                  <input type="text" class="form-control" id="descripcion">
                </div>
              </div>
            </div>
            <div class="row">
              <!-- DIRECCION -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="direccion" class="form-label">Dirección</label>
                  <input type="text" class="form-control" id="direccion">
                </div>
              </div>
              <!-- TELEFONO -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono</label>
                  <input type="tel" class="form-control" id="telefono">
                </div>
              </div>
            </div>
            <div class="row">
              <!-- CORREO -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="correo" class="form-label">Correo</label>
                  <input type="email" class="form-control" id="correo">
                </div>
              </div>
              <!-- Facebook -->
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="facebook" class="form-label">Facebook</label>
                  <input type="text" class="form-control" id="facebook">
                </div>
              </div>
              <!-- WhatsApp -->
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="whatsapp" class="form-label">WhatsApp</label>
                  <input type="text" class="form-control" id="whatsapp">
                </div>
              </div>
            </div>
            <div class="row">
              <!-- Instagram -->
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="instagram" class="form-label">Instagram</label>
                  <input type="text" class="form-control" id="instagram">
                </div>
              </div>
              <!-- TikTok -->
              <div class="col-md-3">
                <div class="mb-3">
                  <label for="tiktok" class="form-label">TikTok</label>
                  <input type="text" class="form-control" id="tiktok">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col md-12">
                <div class="mb-3">                    
                  <label for="pagweb" class="form-label">Página web</label>
                  <input type="text" class="form-control" id="pagweb">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col md-6">
                <div class="mb-3">
                  <label for="logo" class="form-label">Logo negocio</label>
                  <input type="file" id="logo" class="form-control">
                </div>
              </div>
              <div class="col md-6">
                <div class="mb-3">
                  <label for="valoracion" class="form-label">Valoración</label>
                  <input type="number" id="valoracion" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="button" id="guardar">Guardar</button>
          </div>
        </div> <!-- FIN DEL CARD -->
        <br>
      </form> <!-- FIN DEL FORMULARIO-->
    </div> <!-- FIN DEL CONTAINER -->


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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
      document.addEventListener("DOMContentLoaded", () => {
  function $(id) {
    return document.querySelector(id);
  }

  function getSubcategoria() {
    const parametros = new FormData();
    parametros.append("operacion", "listar");

    fetch(`./controllers/subcategoria.controller.php`, {
      method: "POST",
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datos => {
      datos.forEach(element => {
        const etiqueta = document.createElement("option");
        etiqueta.value = element.idsubcategoria;
        etiqueta.innerHTML = element.nomsubcategoria;
        $("#idsubcategoria").appendChild(etiqueta);
      });
    })
    .catch(e => {
      console.error(e);
    });
  }

  function getDistritos() {
    const parametros = new FormData();
    parametros.append("operacion", "listar");

    fetch(`./controllers/distrito.controller.php`, {
      method: "POST",
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datos => {
      datos.forEach(element => {
        const etiqueta = document.createElement("option");
        etiqueta.value = element.iddistrito;
        etiqueta.innerHTML = element.nomdistrito;
        $("#iddistrito").appendChild(etiqueta);
      });
    })
    .catch(e => {
      console.error(e);
    });
  }

  function busqueda() {
    const parametros = new FormData();
    parametros.append("operacion", "buscar");
    parametros.append("nombre_apellido", $("#nombre_apellido").value);

    fetch(`./controllers/persona.controller.php`, {
      method: "POST",
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datos => {
      console.log("Respuesta de búsqueda:", datos);
      const resultadoInput = $("#resultado");
      resultadoInput.value = datos.idpersona;
      resultadoInput.value = datos.datos;

      $("#resultadoBusqueda").style.display = "block";
    })
    .catch(e => {
      console.error("Error en la búsqueda:", e);
    });
  }

  function registrar() {
    const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("iddistrito", $("#iddistrito").value);
        parametros.append("idpersona", $("#nombre_apellido").value);
        parametros.append("idsubcategoria", $("#idsubcategoria").value);
        parametros.append("nroruc", $("#nroruc").value);
        parametros.append("nombre", $("#nombre").value);
        parametros.append("descripcion", $("#descripcion").value);
        parametros.append("direccion", $("#direccion").value);
        parametros.append("telefono", $("#telefono").value);
        parametros.append("correo", $("#correo").value);
        parametros.append("facebook", $("#facebook").value);
        parametros.append("whatsapp", $("#whatsapp").value);
        parametros.append("instagram", $("#instagram").value);
        parametros.append("tiktok", $("#tiktok").value);
        parametros.append("pagweb", $("#pagweb").value);
        parametros.append("logo", $("#logo").files[0]);
        parametros.append("valoracion", $("#valoracion").value);
    // ... (agregar el resto de los parámetros)

    fetch(`./controllers/negocio.controller.php`, {
      method: "POST",
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datos => {
      if(datos.idusuario > 0){
        alert(`Usuario registrado con el ID: ${datos.idusuario}`)
        $("#form-negocio").reset();
            
      }
    })
    .catch(e => {
      console.error("Error en la solicitud:", e);
    });
  }

    $("#buscar").addEventListener("click", busqueda);
    //$("#guardar").addEventListener("click", registrar);

      $("#form-negocio").addEventListener("submit", (event) =>{
        event.preventDefault(); // Stop al evento
        
        if(confirm("¿Está seguro de guardar?")){
          registrar();
        }
      });


  getSubcategoria();
  getDistritos();
});
    </script>
    </body>
</html>

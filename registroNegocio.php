<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- CSS -->
      <link rel="stylesheet" href="./css/sidebar.css">
      <!-- CSS -->
      <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
      <link rel="stylesheet" href="./fonts/icomoon/style.css">
      <link rel="stylesheet" href="./css/owl.carousel.min.css">
      <link rel="stylesheet" href="./css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="./css/toast.css">
      <!----===== Iconscout CSS ===== -->
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
      <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

      <title>Registro Negocio</title> 
    </head>
  <body>
    <nav>
      <div class="logo-name">
        <div class="logo-image">
          <img src="./img/Recurso 1.svg" alt="">
        </div>

        <span class="logo_name">Sting Studio</span>
      </div>
      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="#">
              <i class="uil uil-estate"></i>
              <span class="link-name">Dahsboard</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="uil uil-files-landscapes"></i>
              <span class="link-name">Cliente</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="uil uil-chart"></i>
              <span class="link-name">Analytics</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="uil uil-thumbs-up"></i>
              <span class="link-name">Like</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="uil uil-comments"></i>
              <span class="link-name">Comment</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="uil uil-share"></i>
              <span class="link-name">Share</span>
            </a>
          </li>
        </ul>
            
        <ul class="logout-mode">
          <li>
            <a href="./controllers/usuario.controller.php?operacion=destroy">
            <!-- <a href="../../../controllers/usuario.controller.php?operacion=destroy"> -->
              <i class="uil uil-signout"></i>
              <span class="link-name">Logout</span>
            </a>
          </li>
          <li class="mode">
            <a href="#">
              <i class="uil uil-moon"></i>
              <span class="link-name">Dark Mode</span>
            </a>
            <div class="mode-toggle">
              <span class="switch"></span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <!-- AQUI SE COLOCA EL CONTENIDO DEL DASHBOARD -->
    <section class="dashboard">
      <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="search-box">
          <i class="uil uil-search"></i>
          <input type="text" placeholder="Search here...">
        </div>      
        <img src="./img/2.svg" alt="">
      </div>
      <div class="dash-content">
        <div class="container mt-3">
          <form action="" autocomplete="off" id="form-negocio">
            <div class="card">
              <div class="card-header">
                <div>Registro Negocio</div>
              </div>
              <div class="card-body">
                <div class="row">
                  <!-- NOMBRE COMERCIAL DEL NEGOCIO -->
                  <div class="col md-6">
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre comercial</label>
                      <input type="text" class="form-control" id="nombre">
                    </div>
                  </div>
                  <!-- SUBCATEGORIA DEL NEGOCIO -->
                  <div class="col md-6">
                    <div class="mb-3">
                      <label for="idsubcategoria" class="form-label">Giro negocio</label>
                      <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
                        <option value="">Selecciona</option> 
                      </select>
                    </div>  
                  </div>
                </div>
                <div class="row">
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
                  <!-- RUC -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="nroruc" class="form-label">RUC</label>
                      <input type="tel" class="form-control" id="nroruc">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- DESCRIPCION -->
                  <div class="col md-12">
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
                  <!-- DISTRITO -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="iddistrito" class="form-label">Distrito</label>
                      <select name="iddistrito" id="iddistrito" class="form-select" required>
                        <option value="">Selecciona</option> 
                      </select>
                    </div> 
                  </div>
                </div>
                <div class="row">
                  <!-- TELEFONO -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="telefono class="form-label">Teléfono</label>
                      <input type="tel" class="form-control" id="telefono">
                    </div>
                  </div>
                  <!-- CORREO -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="correo" class="form-label">Correo</label>
                      <input type="email" class="form-control" id="correo">
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
                  <!-- Instagram -->
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="instagram" class="form-label">Instagram</label>
                      <input type="text" class="form-control" id="instagram">
                    </div>
                  </div>
                  <!-- TikTokt -->
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="tiktok" class="form-label">TikTok</label>
                      <input type="text" class="form-control" id="tiktok">
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
                <button class="btn btn-sm btn-primary" type="submit" id="guardar">Guardar</button>
              </div>
            </div> <!-- FIN DEL CARD -->
            <br>
          </form> <!-- FIN DEL FORMULARIO-->
        </div> <!-- FIN DEL CONTAINER -->
      </div>      
    </section>

    <script src="./js/sidebar/script.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.sticky.js"></script>
    <script src="./js//owl.carousel.min.js"></script>
    <script src="./js//main.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded", () =>{
        function $(id){
          return document.querySelector(id);
        }

        function getSubcategoria(){
          const parametros = new FormData();
          parametros.append("operacion", "listar")
          
          fetch(`./controllers/subcategoria.controller.php`,{
            method:"POST",
            body:parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos =>{
            //console.log(datos)
            datos.forEach(element => {
              const etiqueta = document.createElement("option");
              etiqueta.value = element.idsubcategoria;
              etiqueta.innerHTML = element.nomsubcategoria

              $("#idsubcategoria").appendChild(etiqueta);
            });
          })
          .catch(e =>{
            console.error(e)
          });
        }

        function getDistritos(){
          const parametros = new FormData();
          parametros.append("operacion", "listar");

          fetch(`./controllers/distrito.controller.php`,{
            method:"POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos =>{
            datos.forEach(element => {
              const etiqueta = document.createElement("option");
              etiqueta.value = element.iddistrito;
              etiqueta.innerHTML = element.nomdistrito;
              $("#iddistrito").appendChild(etiqueta)
            });
          })
          .catch(e =>{
            console.error(e)
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
          console.log(datos)
          // Modificar el valor del nuevo input con el resultado
          const resultadoInput = $("#resultado");
          resultadoInput.value = datos.idpersona;
          resultadoInput.value = datos.datos; // Asegúrate de reemplazar 'datos.resultado' con el campo correcto

          // Mostrar el div de resultadoBusqueda
          $("#resultadoBusqueda").style.display = "block";
        })
        .catch(e => {
          console.error(e);
        });
      }

      function registrar(){
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

        fetch(`./controllers/negocio.controller.php`,{
          method:"POST",
          body:parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          $("#form-negocio").reset();
        })
        .catch(e =>{
          console.error(e)
        });
      }

      $("#buscar").addEventListener("click", () =>{
        busqueda();
      })

      $("#guardar").addEventListener("click", registrar);
      getSubcategoria();
      getDistritos();
    })
    </script>
</body>
</html>
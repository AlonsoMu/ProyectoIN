<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Lista de Negocios</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  </head>
  <body>
    <style>
      /* Estilo para la tabla */
      #tabla-negocios {
        width: 100%;
        overflow-x: auto; /* Agregar scrollbar horizontal cuando sea necesario */
      }

      /* Estilo para las celdas de la tabla */
      #tabla-negocios th,
      #tabla-negocios td {
        text-align: center; /* Alineación central del texto */
        padding: 8px; /* Agregar espacio interno */
        white-space: nowrap;
      }

      /* Estilo para limitar la longitud de la información y agregar puntos suspensivos */
      .max-width-ellipsis {
        max-width: 150px; /* Cambia este valor según tus necesidades */
        overflow: hidden;
        text-overflow: ellipsis;
      }
    </style>

    <div class="container mt-3">
      <div class="alert alert-info" role="alert">
        <h4>Sting Studio</h4>
        <div>Lista de Negocios</div>
      </div>
      <div class="col-md-6 text-end">
        <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-negocio"><i class="bi bi-plus-circle"></i> Agregar producto</button>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-striped" id="tabla-negocios">
          <colgroup>
            <col width="5%"> <!-- ID -->
            <col width="20%"> <!-- Nombre Comercial -->
            <col width="15%"> <!-- Giro de negocio -->
            <col width="15%"> <!-- Dueño del Negocio -->
            <col width="10%"> <!-- RUC -->
            <col width="5%"> <!-- Distrito -->
            <col width="5%"> <!-- Dirección -->
            <col width="5%"> <!-- Correo -->
            <col width="5%"> <!-- WhatsApp -->
            <col width="5%"> <!-- Telefono -->
            <col width="5%"> <!-- Facebook -->
            <col width="5%"> <!-- Instagram -->
            <col width="5%"> <!-- Tiktok -->
            <col width="10%"> <!-- Información -->
            <col width="5%"> <!-- Logo -->
            <col width="5%"> <!-- Portada -->
            <col width="10%"> <!-- Pagina Web -->
            <col width="10%"> <!-- Valoración -->
            <col width="10%"> <!-- Operaciones -->
          </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Comercial</th>
              <th>Giro de negocio</th>
              <th>Dueño del Negocio</th>
              <th>RUC</th>
              <th>Distrito</th>
              <th>Direccion</th>
              <th>Correo</th>
              <th>WhatsApp</th>
              <th>Telefono</th>
              <th>Facebook</th>
              <th>Instagram</th>
              <th>Tiktok</th>
              <th>Información</th>
              <th>Logo</th>
              <th>Portada</th>
              <th>Página Web</th>
              <th>Valoración</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- DATOS CARGADOS DE FORMA ASINCRONA -->
          </tbody>
        </table>
      </div>
    </div>
    <!--BS5-MODAL-DEFAULT-->  
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modal-negocio" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" autocomplete="off" id="form-negocio">
              <div class="row">
                <!-- NOMBRE COMERCIAL DEL NEGOCIO -->
                <div class="col-md-6">
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
                    <label for="telefono" class="form-label">Teléfono</label>
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
                    <span id="nombreLogo" class="file-name"></span>
                  </div>
                </div>
                <div class="col md-6">
                  <div class="mb-3">
                    <label for="portada" class="form-label">Portada negocio</label>
                    <input type="file" id="portada" class="form-control">
                    <span id="nombrePortada" class="file-name"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="valoracion" class="form-label">Valoración</label>
                    <input type="number" id="valoracion" class="form-control">
                  </div>
                </div>
              </div>
            </form> <!-- FIN DEL FORMULARIO-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"modalVisor data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL VISOR LOGO -->
    <div class="modal fade" id="modal-visor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">Visor de imágenes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="" id="visor" style="width: 100%;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div> <!-- FIN DEL MODAL VISOR LOGO -->

    <!-- MODAL VISOR PORTADA -->
    <div class="modal fade" id="modal-portada" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">Visor de imágenes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="" id="visor-portada" style="width: 100%;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div> <!-- FIN DEL MODAL VISOR PORTADA -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const myModal = new bootstrap.Modal(document.getElementById("modal-negocio"));
        const myModalVisor = new bootstrap.Modal(document.getElementById('modal-visor'));
        const myModalPortada = new bootstrap.Modal(document.getElementById('modal-portada'));
        let sonDatosNuevos = true;
        let idnegocio = -1;

        const tabla = document.querySelector("#tabla-negocios tbody");

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
            resultadoInput.value = datos.idpersona + '' + datos.datos;
            $("#resultadoBusqueda").style.display = "block";
          })
          .catch(e => {
            console.error("Error en la búsqueda:", e);
          });
        }

        function registrar() {
          const parametros = new FormData();
          parametros.append("operacion", "registrar");
          parametros.append("iddistrito",  $("#iddistrito").value);
          parametros.append("idpersona",  $("#resultado").value);
          parametros.append("idsubcategoria",  $("#idsubcategoria").value);
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
          parametros.append("portada", $("#portada").files[0]);
          parametros.append("valoracion", $("#valoracion").value);

          fetch(`./controllers/negocio.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            if (datos.idnegocio > 0) {
              alert(`Usuario registrado con el ID: ${datos.idnegocio}`)
              $("#form-negocio").reset();
              listarNegocios();
            }
          })
          .catch(e => {
            console.error(e);
          });
        }      
        // Comunicación Controlador
        // Renderizar los datos en la Tabla > tbody
        function listarNegocios() {
          // Preparar los parametros a enviar
          const parametros = new FormData();
          parametros.append("operacion", "listarAdm")

          fetch(`./controllers/negocio.controller.php`, {
            method: 'POST',
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            // Recorrer cada fila del arreglo
            let numFila = 1;
            $("#tabla-negocios tbody").innerHTML = '';
            datosRecibidos.forEach(registro => {
              let nuevafila = ``;
              // Enviar los valores obtenidos en celdas <td></td>
              nuevafila = `
              <tr>
                <td>${numFila}</td>
                <td>${registro.NombreComercial}</td>
                <td>${registro.nomsubcategoria}</td>
                <td>${registro.Cliente}</td>
                <td>${registro.nroruc}</td>
                <td>${registro.nomdistrito}</td>
                <td>${registro.direccion}</td>
                <td>${registro.correo}</td>
                <td>${registro.whatsapp}</td>
                <td>${registro.telefono}</td>
                <td>${registro.facebook}</td>
                <td>${registro.instagram}</td>
                <td>${registro.tiktok}</td>
                <td class="max-width-ellipsis">${registro.descripcion}</td>
                <td>
                  <a href='#' class='view' data-idnegocio='${registro.logo}'>Ver imagen</a>
                </td>
                <td>
                  <a href='#' class='view-portada' data-idnegocio='${registro.portada}'>Ver portada</a>
                </td>
                <td>${registro.pagweb}</td>
                <td>${registro.valoracion}</td>
                <td>
                  <button data-idnegocio="${registro.idnegocio}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
                  <button data-idnegocio="${registro.idnegocio}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
                </td>
              </tr>              
              `;
              $("#tabla-negocios tbody").innerHTML += nuevafila;
              numFila++;
            });
          })
          .catch(e => {
            console.error(e)
          })
        }      
        // DETECTANDO click sobre un elemento asíncrono
        // Creado en tiempo de ejecución (ELIMINAR - EDITAR)
        tabla.addEventListener("click", function (event) {
          // Obtener el elemento clickeado
          const target = event.target;
          idnegocio = parseInt(event.target.dataset.idnegocio);

           // VISOR
          if(event.target.classList.contains("view")){
            const logo = event.target.dataset.idnegocio;
            $("#visor").setAttribute("src", `./imgLogos/${logo}`);
            myModalVisor.toggle();
          }

          if(event.target.classList.contains("view-portada")){
            const portada = event.target.dataset.idnegocio;
            $("#visor-portada").setAttribute("src", `./imgPortada/${portada}`);
            myModalPortada.toggle();
          }

          if (target.classList.contains('editar')) {
            // Obtener el idpersona del botón clickeado
            idnegocio = target.getAttribute('data-idnegocio');

            // Obtener datos del cliente por su idpersona
            const parametros = new FormData();
            parametros.append("operacion", "obtenerDatos");
            parametros.append("idnegocio", idnegocio);

            fetch(`./controllers/negocio.controller.php`, {
              method: 'POST',
              body: parametros
            })
            .then(respuesta => respuesta.json())
            .then(datosRecibidos => {
              console.log(datosRecibidos)
              // Asumiendo que solo hay un elemento en el array
              const negocio = datosRecibidos[0];
              document.getElementById("nombre").value = negocio.NombreComercial;
              document.getElementById("idsubcategoria").value = negocio.idsubcategoria;
              document.getElementById("nombre_apellido").value = negocio.Cliente;
              document.getElementById("nroruc").value = negocio.nroruc;
              document.getElementById("descripcion").value = negocio.descripcion;
              document.getElementById("iddistrito").value = negocio.iddistrito;
              document.getElementById("direccion").value = negocio.direccion;
              document.getElementById("telefono").value = negocio.telefono;
              document.getElementById("correo").value = negocio.correo;
              document.getElementById("pagweb").value = negocio.pagweb;
              document.getElementById("facebook").value = negocio.facebook;
              document.getElementById("whatsapp").value = negocio.whatsapp;
              document.getElementById("instagram").value = negocio.instagram;
              document.getElementById("tiktok").value = negocio.tiktok;
              document.getElementById("nombreLogo").textContent = negocio.logo;
              document.getElementById("nombrePortada").textContent = negocio.portada;
              document.getElementById("valoracion").value = negocio.valoracion;

              // Abrir el modal
              myModal.show();
            })
            .catch(e => {
              console.error(e);
            });
          }
        });



        $("#buscar").addEventListener("click", busqueda);
        //$("#guardar").addEventListener("click", registrar);

        $("#guardar").addEventListener("click", (event) => {
          event.preventDefault(); // Evitar que el formulario se envíe automáticamente
          const operacion = $("#guardar").dataset.operacion;

          if (operacion === "registrar") {
            registrar();
          } else if (operacion === "editar") {
            const idnegocio = $("#guardar").dataset.idnegocio;
            editar(idnegocio);
          }
        });

        listarNegocios();
        getSubcategoria();
        getDistritos();

      });  
    </script>
  </body>
</html>

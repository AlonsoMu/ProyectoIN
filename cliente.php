<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>

    <!-- Íconos de Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  </head>
  <body>
    <div class="container mt-3">
      <div class="alert alert-info" role="alert">
        <h4>Sting Studio</h4>
        <div>Lista de Negocios</div>
      </div>
      <div class="col-md-6 text-end">
        <button class="btn btn-success btn-sm" id="abrir-modal"  data-bs-toggle="modal" data-bs-target="#modalId">Agregar persona</button>
      </div>
      <table class="table table-sm table-striped" id="tabla-clientes">
        <colgroup>
          <col width="20%">  <!-- # -->
          <col width="20%"> <!-- datos -->
          <col width="20%"> <!-- numerodoc -->
          <col width="20%"> <!-- negocios -->
          <col width="20%"> <!-- comando -->
        </colgroup>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombres y apellidos</th>
            <th>DNI</th>
            <th>Cantidad de negocios</th>
            <th>Comandos</th>
          </tr>
        </thead>
        <tbody>
            <!-- DATOS CARGADOS DE FORMA ASINCRONA -->
        </tbody>
      </table>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-titulo"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="formulario-cliente" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control">
              </div>
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" id="nombres" name="nombres" class="form-control">
              </div>
              <div class="mb-3">
                <label for="numerodoc" class="form-label">Número de documento</label>
                <input type="text" id="numerodoc" name="numerodoc" class="form-control">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" id="guardarDatos">Save</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" id="confirmarModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title d-flex justify-content-between">
              Eliminar Registro&nbsp;&nbsp;
              <i class="bi bi-shield-fill-exclamation"></i>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>¿Estás seguro de Eliminar Registro?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
          </div>
        </div>
      </div>
    </div> <!-- FIN DEL MODAL ELIMINAR -->
    
    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
      // VanillaJS (JS Puro)
      document.addEventListener("DOMContentLoaded", () => {
        const myModal = new bootstrap.Modal(document.getElementById("modalId"));
        let idpersona = -1;
        let modo = 'registro'; // Variable para controlar si estamos en modo registro o edición

        const tabla = document.querySelector("#tabla-clientes tbody");
        const formularioCliente = document.getElementById("formulario-cliente");
        const apellidosInput = document.getElementById("apellidos");
        const nombresInput = document.getElementById("nombres");
        const numerodocInput = document.getElementById("numerodoc");
        const abrirModalButton = document.getElementById("abrir-modal");

        if (abrirModalButton) {
          abrirModalButton.addEventListener("click", () => {
            modo = 'registro'; // Cambiar al modo registro al abrir el modal
            idpersona = -1; // Reiniciar el idpersona a -1
            formularioCliente.reset(); // Restablecer el formulario
            document.getElementById("modal-titulo").innerText = "Registro de Negocios";
          });
        } else {
          console.error("Elemento con ID 'abrir-modal' no encontrado.");
        }


        function $(id) {
          return document.querySelector(id);
        }

        function listar() {
          const parametros = new FormData();
          parametros.append("operacion", "listaCliente");

          fetch(`./controllers/persona.controller.php`, {
            method: 'POST',
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            let numFila = 1;
            $("#tabla-clientes tbody").innerHTML = '';
            datosRecibidos.forEach(registro => {
              let nuevafila = `
              <tr>
                <td>${numFila}</td>
                <td>${registro.datos}</td>
                <td>${registro.numerodoc}</td>
                <td>${registro.cantidad}</td>
                <td>
                  <button data-idpersona="${registro.idpersona}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
                  <button data-idpersona="${registro.idpersona}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
                </td>
              </tr>`;
              $("#tabla-clientes tbody").innerHTML += nuevafila;
              
              numFila++;
            });
          })
          .catch(e => {
            console.error(e)
          })
        }

        // Agregar evento de clic para los botones de editar
        tabla.addEventListener('click', (event) => {
          const target = event.target;

          if (event.target.classList.contains("eliminar")) {
            const idpersona = event.target.dataset.idpersona;

            // Mostrar el modal de confirmación
            var confirmarModal = new bootstrap.Modal(document.getElementById('confirmarModal'));
            confirmarModal.show();

            // Agregar un evento de clic al botón de confirmar eliminar dentro del modal
            document.getElementById('confirmarEliminarBtn').addEventListener('click', function () {
              // Lógica para eliminar el registro
              const parametros = new FormData();
              parametros.append("operacion", "eliminar");
              parametros.append("idpersona", idpersona);

              fetch(`./controllers/persona.controller.php`, {
                method: "POST",
                body: parametros
              })
              .then(respuesta => respuesta.text())
              .then(datos => {
                console.log(datos);
                // Cerrar el modal después de eliminar
                confirmarModal.hide();
                listar();
              })
              .catch(e => {
                console.error(e);
                // Cerrar el modal en caso de error
                confirmarModal.hide();
              });
            });
          }

          if (target.classList.contains('editar')) {
            modo = 'edicion'; // Cambiar al modo edición
            idpersona = target.getAttribute('data-idpersona');

            // Obtener datos del cliente por su idpersona
            const parametros = new FormData();
            parametros.append("operacion", "obtener");
            parametros.append("idpersona", idpersona);

            fetch(`./controllers/persona.controller.php`, {
              method: 'POST',
              body: parametros
            })
            .then(respuesta => respuesta.json())
            .then(datosRecibidos => {
              console.log(datosRecibidos)
              // Asumiendo que solo hay un elemento en el array
              const primerElemento = datosRecibidos[0];

              // Llenar el formulario con los datos obtenidos
              apellidosInput.value = primerElemento.apellidos || '';
              nombresInput.value = primerElemento.nombres || '';
              numerodocInput.value = primerElemento.numerodoc || '';
              document.getElementById("modal-titulo").innerText = "Editar Negocio";
              // Abrir el modal
              myModal.show();
            })
            .catch(e => {
              console.error(e);
            });
          }
        });

        // Agregar evento de clic para el botón "Save"
        document.getElementById("guardarDatos").addEventListener('click', () => {
          // Obtener los nuevos valores del formulario
          const nuevosDatos = {
            idpersona: idpersona,
            apellidos: apellidosInput.value,
            nombres: nombresInput.value,
            numerodoc: numerodocInput.value
          };

          let url;
          if (modo === 'registro') {
            url = './controllers/persona.controller.php'; // URL para el registro
          } else {
            url = './controllers/persona.controller.php'; // URL para la edición
          }

          const parametrosActualizar = new FormData();
          parametrosActualizar.append("operacion", modo === 'registro' ? 'registrar' : 'editar'); // Usar 'registrar' o 'editar' según el modo
          parametrosActualizar.append("idpersona", nuevosDatos.idpersona);
          parametrosActualizar.append("apellidos", nuevosDatos.apellidos);
          parametrosActualizar.append("nombres", nuevosDatos.nombres);
          parametrosActualizar.append("numerodoc", nuevosDatos.numerodoc);

          fetch(url, {
            method: 'POST',
            body: parametrosActualizar
          })
          .then(respuesta => respuesta.text())
          .then(resultado => {
            console.log(resultado);
            myModal.hide();
            listar();
          })
          .catch(e => {
            console.error(e);
          });
        });

        listar();
      });
    </script>
  </body>
</html>

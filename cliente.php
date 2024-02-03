<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container mt-3">
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
            <h5 class="modal-title" id="modalTitleId">
              Modal title
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="formulario-cliente">
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" class="form-control">
              </div>
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" id="nombres" class="form-control">
              </div>
              <div class="mb-3">
                <label for="numerodoc" class="form-label">Número de documento</label>
                <input type="text" id="numerodoc" class="form-control">
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

    <script>
      // VanillaJS (JS Puro)
      document.addEventListener("DOMContentLoaded", () => {
        const myModal = new bootstrap.Modal(document.getElementById("modalId"));
        let idpersona = -1;

        const tabla = document.querySelector("#tabla-clientes tbody");
        const formularioCliente = document.getElementById("formulario-cliente");
        const apellidosInput = document.getElementById("apellidos");
        const nombresInput = document.getElementById("nombres");
        const numerodocInput = document.getElementById("numerodoc");

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
          if (target.classList.contains('editar')) {
            // Obtener el idpersona del botón clickeado
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

          // Enviar los nuevos datos para la actualización
          const parametrosActualizar = new FormData();
          parametrosActualizar.append("operacion", "editar");
          parametrosActualizar.append("idpersona", nuevosDatos.idpersona);
          parametrosActualizar.append("apellidos", nuevosDatos.apellidos);
          parametrosActualizar.append("nombres", nuevosDatos.nombres);
          parametrosActualizar.append("numerodoc", nuevosDatos.numerodoc);

          fetch(`./controllers/persona.controller.php`, {
            method: 'POST',
            body: parametrosActualizar
          })
          .then(respuesta => respuesta.text())
          .then(resultado => {
            // Aquí puedes manejar la respuesta si es necesario
            console.log(resultado);
            // Cerrar el modal después de actualizar
            myModal.hide();
            // Volver a listar los clientes
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

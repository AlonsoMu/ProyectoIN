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

    function obtenerDatosCliente(id) {
        const parametros = new FormData();
        parametros.append("operacion", "obtener");
        parametros.append("idpersona", id);

        fetch(`./controllers/persona.controller.php`, {
            method: 'POST',
            body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datosRecibidos => {
            if (datosRecibidos.length > 0) {
                const cliente = datosRecibidos[0];
                document.getElementById("apellidos").value = cliente.apellidos;
                document.getElementById("nombres").value = cliente.nombres;
                document.getElementById("numerodoc").value = cliente.numerodoc;
            }
        })
        .catch(e => {
            console.error(e);
        });
    }

    function guardarEdicion() {
        const apellidos = document.getElementById("apellidos").value;
        const nombres = document.getElementById("nombres").value;
        const numerodoc = document.getElementById("numerodoc").value;

        if (!apellidos || !nombres || !numerodoc) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        const datosEditar = {
            idpersona: idpersona,
            apellidos: apellidos,
            nombres: nombres,
            numerodoc: numerodoc
        };

        const parametros = new FormData();
        parametros.append("operacion", "editar");
        parametros.append("idpersona", datosEditar.idpersona);
        parametros.append("apellidos", datosEditar.apellidos);
        parametros.append("nombres", datosEditar.nombres);
        parametros.append("numerodoc", datosEditar.numerodoc);

        fetch(`./controllers/persona.controller.php`, {
    method: 'POST',
    body: parametros
})
.then(respuesta => respuesta.json())
.then(resultado => {
    console.log(resultado);  // Imprime la respuesta en la consola
    if (resultado.success) {
        myModal.hide();
        listar();
    } else {
        alert("Error al editar. Por favor, inténtelo de nuevo.");
    }
})
.catch(e => {
    console.error(e);
});

    }


    tabla.addEventListener("click", function (event) {
    idpersona = parseInt(event.target.dataset.idpersona);

    if (event.target.classList.contains('editar')) {
        obtenerDatosCliente(idpersona);
        myModal.show(); // Agrega esta línea para mostrar el modal al hacer clic en "Editar"
    }
});

// ...

const saveButton = document.querySelector("#modalId .modal-footer .btn-primary");
saveButton.addEventListener("click", guardarEdicion);

// ...

    listar();
});

  </script>
  </body>
</html>

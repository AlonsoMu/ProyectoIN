<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Íconos de Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>
  <style>
    .botones {
      padding: 10px;
      border-radius: 50px;
      font-weight: bold;
      width: 150px;
    }
  </style>

  <div class="container mt-3">
    <button class="btn btn-success btn-sm botones" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modalId">
      Crear&nbsp;&nbsp;
      <i class="bi bi-plus-lg"></i>
    </button>

    <div class="row mt-4">
      <label>
        Filtrar por <i class="bi bi-funnel-fill"></i>
      </label>
    </div>
    <!-- BUSCADOR -->
    <div class="row mt-4">
      <div class="col-md-6">
        <div class=" d-flex justify-content-left">
          <div class="input-group" style="max-width: 300px;">
            <input type="search" id="cliente" class="form-control" />
            <button type="button" id="busqueda" class="bus btn btn-primary">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="col-md-6 text-end"></div>
    <table class="table table-sm table-striped" id="tabla-clientes">
      <colgroup>
        <col width="20%"> <!-- # -->
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/cliente/cliente.js"></script>
  <script>
    // VanillaJS (JS Puro)
    document.addEventListener("DOMContentLoaded", () => {

    });
  </script>
</body>

</html>
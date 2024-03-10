<!DOCTYPE html>
<html lang="es">

<head>
  <title>Lista de Negocios</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Íconos de Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="./css/negocio.css">
</head>

<body>

  <div class="container mt-5">
    <button class="btn btn-success btn-sm botones" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-negocio">
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
            <input type="search" id="nombre_comercial" class="form-control" />
            <button type="button" id="busqueda" class="bus btn btn-primary">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="col-md-6 text-end"></div>
    <div class="table-responsive">
      <table class="table table-sm  table-bordered" id="tabla-negocios">
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
          <col width="10%"> <!-- Operaciones -->
        </colgroup>
        <thead>
          <tr class="table-primary">
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
          <h5 class="modal-title" id="modal-titulo"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="form-negocio" enctype="multipart/form-data">
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
                  <!-- Vista previa del logo -->
                  <!-- <img id="logo-preview" src="#" alt="Vista previa del logo" style="display: none; max-width: 100px; max-height: 100px;"> -->
                </div>
              </div>
              <div class="col md-6">
                <div class="mb-3">
                  <label for="portada" class="form-label">Portada negocio</label>
                  <input type="file" id="portada" class="form-control">
                  <span id="nombrePortada" class="file-name"></span>
                  <!-- Vista previa de la portada -->
                  <!-- <img id="portada-preview" src="#" alt="Vista previa de la portada" style="display: none; max-width: 100px; max-height: 100px;"> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
              </div>
            </div>
          </form> <!-- FIN DEL FORMULARIO-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" modalVisor data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="guardarDatos">Guardar</button>
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


  <!-- Modal para confirmar eliminación -->
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/negocio/negocio.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {

    });
  </script>
</body>

</html>
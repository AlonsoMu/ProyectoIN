<?php

require_once '../models/Ubicacion.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $ubicacion = new Ubicacion();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($ubicacion->listar());
      break;
    case 'obtenerNegocio':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($ubicacion->obtenerNegocio($datos));
      break;
  }
}
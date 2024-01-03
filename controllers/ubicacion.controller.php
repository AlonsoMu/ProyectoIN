<?php

require_once '../models/Ubicacion.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $ubicacion = new Ubicacion();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($ubicacion->listar());
      break;

    case 'listarCategoria':
      enviarJSON($ubicacion->listarCategoria());
      break;

    case 'listarSubcategoria':
      $datos = [
        'idcategoria' => $_POST['idcategoria']
      ];
      enviarJSON($ubicacion->listarSubcategoria($datos));
      break;

    case 'obtenerNegocio':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($ubicacion->obtenerNegocio($datos));
      break;
  }
}
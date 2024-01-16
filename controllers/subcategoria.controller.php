<?php

require_once '../models/Subcategoria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $subcategoria = new Subcategoria();

  switch ($_POST['operacion']) {

    case 'listar':
      $datos = [
        'idcategoria' => $_POST['idcategoria']
      ];
      enviarJSON($subcategoria->listar($datos));
      break;
  }
}
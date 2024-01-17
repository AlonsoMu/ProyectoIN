<?php

require_once '../models/Negocios.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $negocio = new Negocio();

  switch ($_POST['operacion']) {
    
    case 'obtenerNegocio':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($negocio->obtenerNegocio($datos));
      break;
  }
}
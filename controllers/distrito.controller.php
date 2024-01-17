<?php

require_once '../models/Distrito.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $distrito = new Distrito();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($distrito->listar());
      break;
    case 'obtener':
      $datos = [
        'iddistrito' => $_POST['iddistrito']
      ];
      enviarJSON($distrito->obtener($datos));
      break;
  }
}
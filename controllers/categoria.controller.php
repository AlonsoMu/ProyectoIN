<?php

require_once '../models/Categoria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $categoria = new Categoria();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($categoria->listar());
      break;
  }
}
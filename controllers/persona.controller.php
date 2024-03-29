<?php

require_once '../models/Persona.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $persona = new Persona();

  switch ($_POST['operacion']) {
    case 'registrar':
      $datos = [
        'apellidos' => $_POST['apellidos'],
        'nombres' => $_POST['nombres'],
        'numerodoc' => $_POST['numerodoc']
      ];
      enviarJSON($persona->registrar($datos));
      break;
    case 'buscar':
      $datos = [
        'nombre_apellido' => $_POST['nombre_apellido']
      ];
      enviarJSON($persona->buscar($datos));
      break;
    case 'listaCliente':
      enviarJSON($persona->listaCliente());
      break;
    case 'editar':
      $datos = [
        'idpersona' => $_POST['idpersona'],
        'apellidos' => $_POST['apellidos'],
        'nombres' => $_POST['nombres'],
        'numerodoc' => $_POST['numerodoc']
      ];
      $persona->editar($datos);
      break;
    case 'obtener':
      $datos = [
        'idpersona' => $_POST['idpersona']
      ];
      enviarJSON($persona->obtener($datos));
      break;

    case 'eliminar':
      $datos = [
        'idpersona' => $_POST['idpersona']
      ];
      $persona->eliminar($datos);
      break;

    case 'buscarCliente':
      $datos = [
        'cliente' => $_POST['cliente']
      ];
      enviarJSON($persona->buscarCliente($datos));
      break;
  }
}

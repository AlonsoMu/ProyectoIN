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
        'tipodoc' => $_POST['tipodoc'],
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
  }
}
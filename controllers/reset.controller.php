<?php

date_default_timezone_set("America/Lima");
require_once '../models/Reset.php';
require_once '../models/Funciones.php';


$aleatorio = random_int(1000, 9999);

if (isset($_POST['operacion'])) {
  $restablecer = new Reset(); 

  switch ($_POST['operacion']) {
    case 'buscarCorreo':
      $datosEnviar = [
        'correo' => $_POST['correo']
      ];
      echo json_encode($restablecer->buscarCorreo($datosEnviar));

      break;


    case 'buscarToken':
      $datosEnviar = [
        'correo' => $_POST['correo'],
        'token' => $_POST['token']

      ];

      echo json_encode($restablecer->buscarToken($datosEnviar));

      break;
    case 'cambiarpass':
      $ahora = date('dmYhis');
      $nombreEncriptado = sha1($ahora);

      $claveEncriptada = password_hash($_POST['claveacceso'], PASSWORD_BCRYPT);

      $datosEnviar = [
        'correo' => $_POST['correo'],
        'token' => $_POST['token'],
        'claveacceso' => $claveEncriptada

      ];
      echo json_encode($restablecer->cambiarpass($datosEnviar));
  }
}

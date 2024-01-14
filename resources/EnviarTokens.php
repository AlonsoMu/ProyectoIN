<?php

require_once '../models/Reset.php';

$tokens = random_int(1000, 9999);

require_once './PHPMailer.php';


// Controlador
if (isset($_POST['operacion'])) {
  $restablecer = new Reset(); // Crear una instancia del modelo

  switch ($_POST['operacion']) {
      case 'registrartoken':
          $correo = $_POST['correo'];

          $datosEnviar = [
              'correo' => $correo,
              'token' => $tokens
          ];

          $result = $restablecer->registrarToken($datosEnviar);
          //$resultado = enviarEmail($correo,$tokens);
          //echo json_encode($restablecer->registrarToken($datosEnviar));
          break;

  }
}




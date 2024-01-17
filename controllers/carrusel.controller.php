<?php
date_default_timezone_set("America/Lima");
require_once '../models/Carrusel.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
  $carrusel = new Carrusel();

  switch ($_POST['operacion']) {
    case 'registrar':
      $archivo = date('Ymdhis');
      $nombreArchivo = sha1($archivo). ".jpg";
      $datos = [
        'foto' => ''
      ];

      // Solo movemos la imagen si esta existe (uploaded)
      if (isset($_FILES['foto'])) {
        if(move_uploaded_file($_FILES['foto']['tmp_name'], "../images/" . $nombreArchivo)){
          // Enviamos el arreglo al método
          $datos['foto'] = $nombreArchivo;
          enviarJSON($carrusel->registrarlogo($datos));
        } else {
          enviarJSON(['error' => 'Error al mover el archivo']);
        }
      } else {
        enviarJSON(['error' => 'No se proporcionó ninguna imagen']);
      }

      break;
  }
}




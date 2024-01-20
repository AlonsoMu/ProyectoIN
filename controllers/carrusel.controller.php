<?php
session_start();
date_default_timezone_set("America/Lima");

require_once '../models/Carrusel.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
    $carrusel = new Carrusel();

    switch ($_POST['operacion']) {
      case 'registrar':
          $archivo = date('Ymdhis');
          $nombreArchivo = sha1($archivo). ".jpg";
          
          $datosEnviar = [
              'idusuario' => $_SESSION['idusuario'],
              'foto' => ''
          ];

          // Solo movemos la imagen si esta existe (uploaded)
          if (isset($_FILES['foto'])){
              if (move_uploaded_file($_FILES['foto']['tmp_name'], "../imgCarrusel/" . $nombreArchivo)) {
                  $datosEnviar["foto"] = $nombreArchivo;
              }
          }
          
          enviarJSON($carrusel->registrarLogo($datosEnviar));
          break;

      case 'listar':
          enviarJSON($carrusel->listar());
          break;
    }
}
?>

<?php

date_default_timezone_set("America/Lima");

require_once '../models/Galeria.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
    $galeria = new Galeria();

    switch ($_POST['operacion']) {
      case 'registrar':
          $archivo = date('Ymdhis');
          $nombreArchivo = sha1($archivo). ".jpg";
          
          $datosEnviar = [
              'idnegocio' => $_POST['idnegocio'],
              'rutafoto' => ''
          ];

          // Solo movemos la imagen si esta existe (uploaded)
          if (isset($_FILES['rutafoto'])){
              if (move_uploaded_file($_FILES['rutafoto']['tmp_name'], "../imgGaleria/" . $nombreArchivo)) {
                  $datosEnviar["rutafoto"] = $nombreArchivo;
              }
          }
          
          enviarJSON($galeria->registrar($datosEnviar));
          break;

    }
}
?>

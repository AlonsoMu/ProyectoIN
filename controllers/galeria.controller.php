<?php

date_default_timezone_set("America/Lima");

require_once '../models/Galeria.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
    $galeria = new Galeria();

    switch ($_POST['operacion']) {
      /*case 'registrar':
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
          break;*/

          case 'registrar':
            
            // Directorio de destino
            $directorioDestino = "../imgGaleria/";

            // Array para almacenar los nombres de archivo de las fotos
            $nombresArchivos = array();

            //ARRAY DE RESPUESTAS
            $respuetas = []; 

            if (isset($_FILES['rutafoto'])) {
                foreach ($_FILES['rutafoto']['tmp_name'] as $index => $tempName) {
                    $ahora = date("dmYhis");
                    $nombreArchivo = sha1($ahora . $index) . ".jpg";
                    $rutaCompleta = $directorioDestino . $nombreArchivo;
        
                    if (move_uploaded_file($tempName, $rutaCompleta)) {
                        $nombresArchivos[] = $nombreArchivo;
                        
                        $datosEnviar =[
            
                            "idnegocio" => $_POST['idnegocio'],
                            "rutafoto" => $nombreArchivo
                        ];
                        
                        $respuetas = $galeria->registrar($datosEnviar);
                    }
                }
            }

            echo json_encode($respuetas);

            

            /*if(move_uploaded_file($_FILES['rutafoto']['tmp_name'], "../images/" . $nombreArchivo)){
                $datosEnviar['rutafoto'] = $nombreArchivo;
            }*/

            break;

    }
}
?>

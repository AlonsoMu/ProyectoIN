<?php

date_default_timezone_set("America/Lima");

require_once '../models/Galeria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
    $galeria = new Galeria();

    switch ($_POST['operacion']) {


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

                        $datosEnviar = [

                            "idnegocio" => $_POST['idnegocio'],
                            "rutafoto" => $nombreArchivo
                        ];

                        $respuetas = $galeria->registrar($datosEnviar);
                    }
                }
            }

            echo json_encode($respuetas);

            break;
        case 'listar':
            $datosEnviar = ["idnegocio" => $_POST["idnegocio"]];
            echo json_encode($galeria->listar($datosEnviar));
            break;
    }
}

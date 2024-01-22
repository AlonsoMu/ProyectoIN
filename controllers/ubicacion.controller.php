<?php

require_once '../models/Ubicacion.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $ubicacion = new Ubicacion();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($ubicacion->listar());
      break;
    case 'obtenerNegocio':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($ubicacion->obtenerNegocio($datos));
      break;

    
      case 'obtenerdist':
        $formato = 'EEEE'; 
        $idioma = 'es';
    
        $intlDateFormatter = new IntlDateFormatter(
            $idioma,
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            null,
            null,
            $formato
        );
    
        $dia_actual = $intlDateFormatter->format(time());
    
        $datos = [
            'idsubcategoria' => $_POST['idsubcategoria'],
            'iddistrito' => $_POST['iddistrito'],
            'dia_actual' => $dia_actual
        ];
    
        $resultados = $ubicacion->obtenerDistrito($datos);
    
        if (empty($resultados)) {
            // No se encontraron negocios en este distrito
            enviarJSON(['mensaje' => 'No se encontraron negocios en este distrito para la subcategoría dada.']);
        } else {
            // Se encontraron negocios, enviar la respuesta normalmente
            enviarJSON($resultados);
        }
    
        break;
  }
}



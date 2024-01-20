<?php

require_once '../models/Negocios.php';
require_once '../models/Funciones.php';

date_default_timezone_set("America/Lima");

if (isset($_POST['operacion'])) {
  $negocio = new Negocio();

  switch ($_POST['operacion']) {
    
    case 'obtenerNegocio':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($negocio->obtenerNegocio($datos));
    break;
  
    case 'obtenerNyH':
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
        'dia_actual' => $dia_actual
      ];
      enviarJSON($negocio->obtenerNyH($datos));
    break;
    case 'obtenerSyD':
      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria'],
        'iddistrito' => $_POST['iddistrito']
      ];
      enviarJSON($negocio->obtenerSyD($datos));
    break;
    case 'buscar':
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
    
      try {
        // Verificar si el campo "valor" está vacío o nulo
        if (isset($_POST["valor"]) && !empty($_POST["valor"])) {
          $datosEnviar = [
            "valor"  => $_POST["valor"],
            'dia_actual' => $dia_actual
          ];
          $resultados = $negocio->buscar($datosEnviar);
    
          if (!empty($resultados)) {
            // Si hay resultados, enviar el JSON normal
            enviarJson($resultados);
          } else {
            // Si no hay resultados, enviar un JSON específico
            $jsonRespuesta = [
              'mensaje' => 'No se encontraron negocios.',
              'error' => true
            ];
            echo json_encode($jsonRespuesta);
          }
        } else {
          // Retornar un JSON indicando que no se proporcionó un valor para la búsqueda
          $jsonRespuesta = [
            'mensaje' => 'No se proporcionó un valor para la búsqueda.',
            'error' => true
          ];
          echo json_encode($jsonRespuesta);
        }
      } catch (Exception $e) {
        // Capturar cualquier excepción y devolver un JSON de error
        $jsonError = [
          'mensaje' => 'Error al procesar la búsqueda.',
          'error' => true
        ];
        echo json_encode($jsonError);
      }
    break;
  }
}
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
  }
}
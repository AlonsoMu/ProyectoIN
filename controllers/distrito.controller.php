<?php

require_once '../models/Distrito.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $distrito = new Distrito();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJSON($distrito->listar());
      break;
    case 'obtener':
      $datos = [
        'iddistrito' => $_POST['iddistrito']
      ];
      enviarJSON($distrito->obtener($datos));
      break;
    case 'obtenerNyH1':
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
      enviarJSON($distrito->obtenerNyH($datos));
      break;
  }
}

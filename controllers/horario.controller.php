<?php

date_default_timezone_set("America/Lima");

require_once '../models/Horario.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
    $horario = new Horario();

    switch ($_POST['operacion']) {
      case 'obtenerHorarios':
        $datosEnviar = ["idnegocio" => $_POST["idnegocio"]];
        echo json_encode($horario->obtenerHorarios($datosEnviar));
      break;
    }
}
?>
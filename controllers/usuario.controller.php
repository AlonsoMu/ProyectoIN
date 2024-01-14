<?php
session_start();
// require_once '../models/Email.php';
require_once '../models/Usuario.php';
require_once '../models/Funciones.php';
require_once './Filtro.php';

if(isset($_POST['operacion'])){
  $usuario = new Usuario();

  switch ($_POST['operacion']) {
    case 'buscar':
      enviarJSON($usuario->login($_POST));
      break;
    case 'login':
      $datosEnviar = ["correo" => $_POST["correo"]];
      $registro = $usuario->login($datosEnviar);

      $statusLogin = [
        "acceso" => false,
        "mensaje" => ""
      ];

      if($registro == false){
        $_SESSION["status"] = false;
        $statusLogin["mensaje"] = "No existe el correo";
      }else{
        $claveEncriptada = $registro["claveacceso"];
        $_SESSION["idusuario"] = $registro["idusuario"];
        // $_SESSION["apellidos"] = $registro["apellidos"];
        // $_SESSION["nombres"] = $registro["nombres"];
        $_SESSION["idpersona"] = $registro["idpersona"];
        $_SESSION["nivelacceso"] = $registro["nivelacceso"];

        if(password_verify($_POST["claveacceso"], $claveEncriptada)){
          $_SESSION["status"] = true;
          $statusLogin["acceso"] = true;
          $statusLogin["mensaje"] = "Acceso correcto";
        }else{
          $_SESSION["status"] = false;
        $statusLogin["mensaje"] = "Error en la contraseña";
        }
      }
      enviarJSON($statusLogin);
    break;
  }
}




if (isset($_GET['operacion'])){
  if ($_GET['operacion'] == 'destroy') {
    session_destroy();
    session_unset();
    header("Location:../views/usuarios/index.php");
  }
}
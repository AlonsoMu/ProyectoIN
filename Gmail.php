<?php

require_once 'Conexion.php';

class Gmail extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }
  

  public function registrar($datos = []) {
    try {
        $consulta = $this->conexion->prepare("CALL spu_registrar_visita(?,?,?,?,?)");
        $consulta->execute([
            $datos['user_google_id'],
            $datos['user_first_name'],
            $datos['user_last_name'],
            $datos['user_email_address'],
            $datos['user_image']
        ]);
        return true; // Retorna true si la inserción fue exitosa
    } catch (Exception $e) {
        // Manejar el error de alguna manera apropiada
        die($e->getMessage());
    }
}

}
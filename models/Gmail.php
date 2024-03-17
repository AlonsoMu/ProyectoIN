<?php

require_once '../models/Conexion.php';

class Gmail extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }
  

  public function registrar($datos = []) {
    try {
        $consulta = $this->conexion->prepare("CALL spu_registrar_visita(?,?,?)");
        $consulta->execute([
            $datos['email'],
            $datos['name_google'],
            $datos['picture']
        ]);
        return true; // Retorna true si la inserción fue exitosa
    } catch (Exception $e) {
        // Manejar el error de alguna manera apropiada
        die($e->getMessage());
    }
  }

}
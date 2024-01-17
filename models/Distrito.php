<?php

require_once 'Conexion.php';

class Distrito extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_distritos_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function obtener($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_obtener_coordenadas(?)");
      $consulta->execute(
        array(
          $datos['iddistrito']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  
  //------------------------------------------------------------------------------------
}
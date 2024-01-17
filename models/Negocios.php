<?php

require_once 'Conexion.php';

class Negocio extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function obtenerNegocio($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_obtener_negocios(?)");
      $consulta->execute(
        array(
          $datos['idsubcategoria']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtenerNyH($datos = []){
    try {
      
      $consulta = $this->conexion->prepare("CALL spu_obtener_negocios_y_disponibilidad(?,?)");
      $consulta->execute(
        array(
          $datos['idsubcategoria'],
          $datos['dia_actual'],
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
    

  

  
  //------------------------------------------------------------------------------------
}
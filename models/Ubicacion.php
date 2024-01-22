<?php

require_once 'Conexion.php';

class Ubicacion extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }


  public function listar(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_ubicaciones_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
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

  

  public function obtenerDistrito($datos = []){
    try {
      
      $consulta = $this->conexion->prepare("CALL spu_obtener_dist(?,?,?)");
      $consulta->execute(
        array(
          $datos['idsubcategoria'],
          $datos['iddistrito'],
          $datos['dia_actual']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  
  //------------------------------------------------------------------------------------
}
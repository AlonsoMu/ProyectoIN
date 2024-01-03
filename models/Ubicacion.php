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

  public function listarCategoria(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_categorias_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarSubcategoria($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_subcategorias_listar(?)");
      $consulta->execute(
        array(
          $datos['idcategoria']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
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

  
  //------------------------------------------------------------------------------------
}
<?php

require_once 'Conexion.php';

class Subcategoria extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_subcategorias_listar(?)");
      $consulta->execute(array(
        $datos['idcategoria']
      ));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  
  //------------------------------------------------------------------------------------
}
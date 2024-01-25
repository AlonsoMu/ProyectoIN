<?php

require_once 'Conexion.php';

class Galeria extends Conexion{
  public $conexion;

  public function __construct()
  {
    $this->conexion = parent::getConexion();
  }


 /* public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_galerias_registrar(?,?)");
      $consulta->execute(
        array(
          $datos['idnegocio'],
          $datos['rutafoto']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }*/

  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_galeria_registrar(?,?)");
      $consulta->execute(
        array(
          $datos['idnegocio'],
          $datos['rutafoto']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }




}
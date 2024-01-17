<?php

require_once 'Conexion.php';

class Carrusel extends Conexion{
  public $conexion;

  public function __construct()
  {
    $this->conexion = parent::getConexion();
  }


  public function registrarlogo($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_carrusel_registrar(?)");
      $consulta->execute(
        array(
          $datos['foto']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }



}
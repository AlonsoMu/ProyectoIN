<?php

require_once 'Conexion.php';

class Horario extends Conexion{
  public $conexion;

  public function __construct()
  {
    $this->conexion = parent::getConexion();
  }
  public function obtenerHorarios($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_horarios_negocios(?)");
      $consulta->execute(
        array(
          $datos['idnegocio']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage()); 
    }
  }




}
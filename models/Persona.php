<?php

require_once 'Conexion.php';

class Persona extends Conexion{
  public $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_personas_registrar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos['apellidos'],
          $datos['nombres'],
          $datos['tipodoc'],
          $datos['numerodoc']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  
  public function buscar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_personas_buscar(?)");
      $consulta->execute(
        array(
          $datos['nombre_apellido']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listaCliente($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_clientes_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function editar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_cliente_actualizar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idpersona'],
          $datos['apellidos'],
          $datos['nombres'],
          $datos['numerodoc']
        )
      ); 
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtener($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_clientes_obtener(?)");
      $consulta->execute(
        array(
          $datos['idpersona']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}

?>
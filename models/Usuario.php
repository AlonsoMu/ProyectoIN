<?php

require_once 'Conexion.php';

class Usuario extends Conexion{
  public $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function login($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_login(?)");
      $consulta->execute(
        array(
          $datos['correo']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_usuarios_registrar(?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idpersona'],
          $datos['avatar'],
          $datos['correo'],
          $datos['claveacceso'],
          $datos['nivelacceso']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listar(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_usuarios_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage()); //Desarrollo > Producción
    }
  }

  
}

?>
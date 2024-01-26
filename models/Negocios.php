<?php

require_once 'Conexion.php';

class Negocio extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  /*public function obtenerNegocio($datos = []){
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
  }*/

  public function obtenerNyH($datos = []){
    try {
      
      $consulta = $this->conexion->prepare("CALL spu_obtener_nyh(?,?)");
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
  
  /*public function obtenerSyD($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_obtener_negocios_subdis(?,?)");
      $consulta->execute(
        array(
          $datos['idsubcategoria'],
          $datos['iddistrito'],
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
*/
  public function buscar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_busqueda(?,?)");
      $consulta->execute(
        array(
          $datos['valor'],
          $datos['dia_actual']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  

  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_registrar(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['iddistrito'],
          $datos['idpersona'],
          $datos['idsubcategoria'],
          $datos['nroruc'],
          $datos['nombre'],
          $datos['descripcion'],
          $datos['direccion'],
          $datos['telefono'],
          $datos['correo'],
          $datos['facebook'],
          $datos['whatsapp'],
          $datos['instagram'],
          $datos['tiktok'],
          $datos['pagweb'],
          $datos['logo'],
          $datos['valoracion']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function buscarNegocio($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL buscar_negocios(?)");
      $consulta->execute(
        array(
          $datos['negocio']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listar(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
    

  

  
  //------------------------------------------------------------------------------------
}
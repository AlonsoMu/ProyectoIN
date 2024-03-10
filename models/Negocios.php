<?php

require_once 'Conexion.php';

class Negocio extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }


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
          $datos['portada']
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

  public function listarSubyDis($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listarSubyDis(?,?)");
      $consulta->execute(
        array(
          $datos['idsubcategoria'],
          $datos['iddistrito']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarPorSub($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listaCardsSub(?)");
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

  public function listarPorDis($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listaCardsDistrito(?)");
      $consulta->execute(
        array(
          $datos['iddistrito']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function busquedaCard($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_busquedaCard(?)");
      $consulta->execute(
        array(
          $datos['nombre_comercial']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtenerid($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_obtener_id(?,?)");
      $consulta->execute(
        array(
          $datos['idnegocio'],
          $datos['dia_actual']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtenerMapa($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL negocioMap(?)");
      $consulta->execute(
        array(
          $datos['idnegocio']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarAdm(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listar_adm()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function inactive($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_eliminar_negocio(?)");
      $consulta->execute(
        array(
          $datos['idnegocio']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function editar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_editar_negocio(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idnegocio'],
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
          $datos['portada']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtenerDatos($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_negocios_listar_obt(?)");
      $consulta->execute(
        array(
          $datos['idnegocio']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  
  public function busquedaNegocios($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_busquedas_negocios(?)");
      $consulta->execute(array(
        $datos['nombre_comercial']
      ));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function busquedaGeneral(){
    try {
      $consulta = $this->conexion->prepare("CALL spu_busqueda_general()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
    

  

  
  //------------------------------------------------------------------------------------
}
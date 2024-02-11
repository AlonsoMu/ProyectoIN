<?php

require_once 'Conexion.php';

class Subcategoria extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar($datos = []){
    try {
      $consulta = $this->conexion->prepare("CALL spu_subcategorias_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarsub() {
    try {
      $consulta = $this->conexion->prepare("CALL spu_subcategorias_listartodo()");
      $consulta->execute();
      $subcategorias = $consulta->fetchAll(PDO::FETCH_ASSOC);

      // Agrupar subcategorías por categoría
      $subcategoriasAgrupadas = array();
      foreach ($subcategorias as $sub) {
        $categoriaNombre = $sub['nomcategoria'];
        $subcategoriasAgrupadas[$categoriaNombre][] = $sub;
      }

      return $subcategoriasAgrupadas;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }



  
  //------------------------------------------------------------------------------------
}
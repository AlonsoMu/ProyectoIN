<?php

require_once '../models/Conexion.php';

class Gmail extends Conexion
{
  private $conexion;

  public function __CONSTRUCT()
  {
    $this->conexion = parent::getConexion();
  }


  public function registrar($datos = [])
  {
    try {
      $consulta = $this->conexion->prepare("CALL spu_registrar_visita(?,?,?)");
      $consulta->execute([
        $datos['email'],
        $datos['name_google'],
        $datos['picture']
      ]);
      return true; // Retorna true si la inserción fue exitosa
    } catch (Exception $e) {
      // Manejar el error de alguna manera apropiada
      die($e->getMessage());
    }
  }


  public function verificar($datos = [])
  {
    try {

      $consulta = $this->conexion->prepare("CALL spu_buscar_correo_visita(?)");
      $consulta->execute(
        array(
          $datos['email']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function verificarid($datos = [])
  {
    try {
      $consulta = $this->conexion->prepare("CALL spu_verificar_id(?)");
      $consulta->bindParam(1, $datos['email'], PDO::PARAM_STR);
      $consulta->execute();

      // Obtener el resultado de la consulta
      $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

      if ($resultado) {
        return $resultado['idvisita'];
      } else {
        return null; // O manejar el caso cuando no se encuentra ninguna visita asociada al correo electrónico
      }
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  
}

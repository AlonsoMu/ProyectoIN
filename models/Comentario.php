<?php

require_once '../models/Conexion.php';

class Comentario extends Conexion
{
    private $conexion;

    public function __CONSTRUCT()
    {
        $this->conexion = parent::getConexion();
    }


    public function registrar($datos = [])
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_registrar_comentarios(?,?,?,?)");
            $consulta->execute([
                $datos['idvisita'],
                $datos['idnegocio'],
                $datos['comentario'],
                $datos['valoracion']
            ]);
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function comentarioGeneral()
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_obtener_comentarios()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function obtenerComentario($datos = [])
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_obtener_comentarios_id(?)");
            $consulta->execute(
                array(
                    $datos['idcomentario']
                )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function editar($datos = [])
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_actualizar_comentario(?,?,?)");
            $consulta->execute(
                array(
                    $datos['idcomentario'],
                    $datos['comentario'],
                    $datos['valoracion']
                )
            );
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar($datos = [])
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_eliminar_comentario(?)");
            $consulta->execute(
                array(
                    $datos['idcomentario']
                )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

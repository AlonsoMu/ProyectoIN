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
            $consulta = $this->conexion->prepare("CALL spu_registrar_comentarios(?,?,?)");
            $consulta->execute([
                $datos['idvisita'],
                $datos['idnegocio'],
                $datos['comentario']
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
                    $datos['idnegocio']
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

    public function verificarid($datos = [])
    {
        try {
            $consulta = $this->conexion->prepare("CALL spu_obtener_idvisita_por_comentario(?)");
            $consulta->bindParam(1, $datos['idcomentario'], PDO::PARAM_INT); // Cambiar a PDO::PARAM_INT
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

<?php

require_once '../models/Comentario.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
    $comentario = new Comentario();

    switch ($_POST['operacion']) {
        case 'comentarioGeneral':
            enviarJSON($comentario->comentarioGeneral());
            break;
        case 'obtenerComentario':
            $datos = [
                'idcomentario' => $_POST['idcomentario']
            ];
            enviarJSON($comentario->obtenerComentario($datos));
            break;
        case 'registrarComentario':
            $datos = [
                'idvisita' => $_POST['idvisita'],
                'idnegocio' => $_POST['idnegocio'],
                'comentario' => $_POST['comentario'],
                'valoracion' => $_POST['valoracion']
            ];
            enviarJSON($comentario->registrar($datos));
            break;
        case 'editarComentario':
            $datos = [
                'idcomentario' => $_POST['idcomentario'],
                'comentario' => $_POST['comentario'],
                'valoracion' => $_POST['valoracion']
            ];
            enviarJSON($comentario->editar($datos));
            break;
        case 'eliminarComentario':
            $datos = [
                'idcomentario' => $_POST['idcomentario']
            ];
            enviarJSON($comentario->eliminar($datos));
            break;
    }
}

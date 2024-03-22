<?php
session_start();
require_once '../models/Comentario.php';
require_once '../models/Funciones.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el campo 'accion'
    if (isset($_POST['operacion'])) {
        // Crear una instancia del modelo Comentario
        $comentario = new Comentario();

        // Obtener el valor del campo 'accion'
        $accion = $_POST['operacion'];

        // Utilizar un switch para manejar diferentes operaciones según el valor de 'accion'
        switch ($accion) {
            case 'registrarComentario':
                // Obtener los datos del formulario
                $idvisita = $_POST['idvisita'];
                $idnegocio = $_POST['idnegocio'];
                $comentarioTexto = $_POST['comentario'];

                // Crear un arreglo con los datos del comentario
                $datos = [
                    'idvisita' => $idvisita,
                    'idnegocio' => $idnegocio,
                    'comentario' => $comentarioTexto
                ];

                // Registrar el comentario y obtener el resultado
                $resultado = $comentario->registrar($datos);

                // Enviar una respuesta JSON con el resultado del registro
                enviarJSON($resultado);


                header('Location: ../views/menu.php?id=' . $_SESSION['musica'] .'#formulario-comentario');
                exit;
                break;

                // Agregar más casos según sea necesario para otras operaciones
            case 'listar':
                $datos = [
                    'idnegocio' => $_POST['idnegocio']
                ];
                enviarJSON($comentario->obtenerComentario($datos));
                break;

            case 'listar':
                $datos = [
                    'idnegocio' => $_POST['idnegocio']
                ];
                enviarJSON($comentario->obtenerComentario($datos));
                break;

            case 'eliminar':
                $datos = [
                    'idcomentario' => $_POST['idcomentario']
                ];
                enviarJSON($comentario->eliminar($datos));
                break;

        
        }
    }
}


/*if (isset($_POST['operacion'])) {
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
                'comentario' => $_POST['comentario']
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
}*/

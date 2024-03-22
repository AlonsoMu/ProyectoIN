<?php
session_start();

require_once '../models/Gmail.php';

if (!isset($_SESSION['google_loggedin']) || $_SESSION['google_loggedin'] !== true) {
    // Si no hay una sesión activa, redirigir al inicio de sesión de Google
    header('Location: google-auth.php');
    exit;
}

// Obtener los datos del usuario de la sesión
$user_email = $_SESSION['google_email'];

// Verificar si el correo electrónico ya existe en la base de datos
$gmail_model = new Gmail();
$usuario_existente = $gmail_model->verificar(['email' => $user_email]);

if ($usuario_existente) {

    $usuario_id = $gmail_model->verificarid(['email' => $user_email]);
    $_SESSION["idvisitax"] = $usuario_id;

    // Si el usuario ya existe en la base de datos, redirigir al menú
    header('Location: ../views/menu.php?id=' . $_SESSION['musica']);
    exit;
} else {

    
    // Si el usuario no existe en la base de datos, mostrar un mensaje de alerta
    $user_email = $_SESSION['google_email'];
    $user_name = $_SESSION['google_name'];
    $user_picture = $_SESSION['google_picture'];

    // Insertar los datos del usuario en la base de datos
    $gmail_model = new Gmail();
    $registro_exitoso = $gmail_model->registrar([
        'email' => $user_email,
        'name_google' => $user_name,
        'picture' => $user_picture
    ]);

    if ($registro_exitoso) {
        $usuario_id = $gmail_model->verificarid(['email' => $user_email]);
        $_SESSION["idvisitax"] = $usuario_id;
        // Redirigir al menú después de la inserción exitosa en la base de datos
        header('Location: ../views/menu.php?id=' . $_SESSION['musica']);
        exit;
    } else {
        exit('¡Error al registrar el usuario en la base de datos!');
    }
}


/*$user_name = $_SESSION['google_name'];
$user_picture = $_SESSION['google_picture'];

// Insertar los datos del usuario en la base de datos
$gmail_model = new Gmail();
$registro_exitoso = $gmail_model->registrar([
    'email' => $user_email,
    'name_google' => $user_name,
    'picture' => $user_picture
]);

if ($registro_exitoso) {
    // Redirigir al menú después de la inserción exitosa en la base de datos
    header('Location: ../views/menu.php');
    exit;
} else {
    exit('¡Error al registrar el usuario en la base de datos!');
}*/

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
    // Redirigir al menú después de la inserción exitosa en la base de datos
    header('Location: ../views/menu.php');
    exit;
} else {
    exit('¡Error al registrar el usuario en la base de datos!');
}
?>

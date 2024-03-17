<?php
session_start();

require_once '../models/Gmail.php';

$google_oauth_client_id = '57690745522-4nsmqkdhj7qebt3k40tgfnq8kcr0r857.apps.googleusercontent.com';
$google_oauth_client_secret = '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';
$google_oauth_redirect_uri = 'http://localhost/ProyectoIN/views/google-oauth.php';
$google_oauth_version = 'v3';

if (isset($_GET['code']) && !empty($_GET['code'])) {
    // Obtener el token de acceso de Google
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    // Verificar si se obtuvo un token de acceso válido
    if (isset($response['access_token']) && !empty($response['access_token'])) {
        // Obtener información del perfil del usuario desde Google
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);
        
        // Verificar si se obtuvo la información del perfil
        if (isset($profile['email'])) {
            // Almacenar los datos del usuario en la base de datos
            $gmail_model = new Gmail();
            $registro_exitoso = $gmail_model->registrar([
                'email' => $profile['email'],
                'name_google' => $profile['given_name'] . ' ' . $profile['family_name'],
                'picture' => isset($profile['picture']) ? $profile['picture'] : ''
            ]);
            
            if ($registro_exitoso) {
                // Autenticar al usuario y redirigir
                session_regenerate_id();
                $_SESSION['google_loggedin'] = true;
                $_SESSION['google_email'] = $profile['email'];
                $_SESSION['google_name'] = $profile['given_name'] . ' ' . $profile['family_name'];
                $_SESSION['google_picture'] = isset($profile['picture']) ? $profile['picture'] : '';
                header('Location: menu.php');
                exit;
            } else {
                exit('¡Error al registrar el usuario en la base de datos!');
            }
        } else {
            exit('¡No se pudo recuperar la información del perfil! ¡Por favor, inténtelo de nuevo más tarde!');
        }
    } else {
        exit('¡Token de acceso no válido! ¡Por favor, inténtelo de nuevo más tarde!');
    }
} else {
    // Si no se recibió el parámetro 'code', redirigir al usuario para la autenticación
    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}
?>

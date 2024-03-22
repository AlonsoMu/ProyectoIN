<?php
session_start();

$google_oauth_client_id = '57690745522-4nsmqkdhj7qebt3k40tgfnq8kcr0r857.apps.googleusercontent.com';
$google_oauth_client_secret = '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';
$google_oauth_redirect_uri = 'http://localhost/ProyectoIN/modelGmail/google-oauth.php';
$google_oauth_version = 'v3';


 
if (isset($_GET['code']) && !empty($_GET['code'])) {
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
    
    //TOKEN VALIDO
    if (isset($response['access_token']) && !empty($response['access_token'])) {

        // CURL RECUPERA INFORMACION DE USUARIO ASOCIADA A GOOGLE
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);
        
        //PERFIL SI EXISTE
        if (isset($profile['email'])) {
            $google_name_parts = [];
            $google_name_parts[] = isset($profile['given_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['given_name']) : '';
            $google_name_parts[] = isset($profile['family_name']) ? preg_replace('/[^a-zA-Z0-9]/s', '', $profile['family_name']) : '';
            
            //AUTENTIFICAR USUARIO
            session_regenerate_id();
            $_SESSION['google_loggedin'] = TRUE;
            $_SESSION['google_email'] = $profile['email'];
            $_SESSION['google_name'] = implode(' ', $google_name_parts);
            $_SESSION['google_picture'] = isset($profile['picture']) ? $profile['picture'] : '';
            
            //REDIRECT UBICACIÓN DE PERGIL
            header('Location: insert-db.php');
            exit;
        } else {
            exit('¡No se pudo recuperar la información del perfil! ¡Por favor, inténtelo de nuevo más tarde!');
        }
    } else {
        exit('¡Token de acceso no válido! ¡Por favor, inténtelo de nuevo más tarde!');
    }
} else {

    //PARAMETROS AUTEN GOOGLE
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
<?php

//Include Configuration File
include('config.php');

include('Gmail.php');

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        $gmail = new Gmail();
        $datos = [
            'user_google_id' => $data['id'],
            'user_first_name' => $data['given_name'],
            'user_last_name' => $data['family_name'],
            'user_email_address' => $data['email'],
            'user_image' => $data['picture']
        ];
        
        
        $gmail->registrar($datos);
    }
}

?>

<?php

//start session on web page


//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID | Copiar "ID DE CLIENTE"
$google_client->setClientId('57690745522-4nsmqkdhj7qebt3k40tgfnq8kcr0r857.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
$google_client->setRedirectUri('http://localhost/ProyectoIN/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>
<?php

require_once ROOT_PATH . '/vendor/autoload.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId(OAUTH_GOOGLE_CLIENT_ID);
$client->setClientSecret(OAUTH_GOOGLE_SECRET);
$client->setRedirectUri(ROOT_URL . '/login/google/');
$client->addScope("email");
$client->addScope("profile");
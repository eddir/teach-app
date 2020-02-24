<?php

require_once ROOT_PATH . '/vendor/autoload.php';

// create Client Request to access Google API
$gclient = new Google_Client();
$gclient->setClientId(OAUTH_GOOGLE_CLIENT_ID);
$gclient->setClientSecret(OAUTH_GOOGLE_SECRET);
$gclient->setRedirectUri(ROOT_URL . '/login/google.php');
$gclient->addScope("email");
$gclient->addScope("profile");
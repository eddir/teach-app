<?php

include_once '../../app/init.php';
include_once ROOT_APP . '/auth/google/google.php';


echo $blade->run("login", ['google_login_url' => $client->createAuthUrl()]);
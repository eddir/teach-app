<?php

include_once '../../app/init.php';


include_once ROOT_APP . '/auth/googleService.php';
include_once ROOT_APP . '/auth/vkontakteService.php';

echo $blade->run("login", [
    'google_login_url' => $gclient->createAuthUrl(),
    'vkontakte_login_url' => $vk_oauth_url,
    'failed' => isset($_GET['failed'])
]);
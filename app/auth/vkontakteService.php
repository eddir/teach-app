<?php

$url = 'http://oauth.vk.com/authorize';

$params = array(
    'client_id' => OAUTH_VK_CLIENT_ID,
    'redirect_uri' => ROOT_URL . '/login/vkontakte.php',
    'response_type' => 'code',
    'scope' => 'email',
    'v' => '5.103'
);

$vk_oauth_url = $url . '?' . urldecode(http_build_query($params));
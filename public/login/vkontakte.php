<?php
include_once '../../app/init.php';
include_once ROOT_APP . '/auth/googleService.php';


if (isset($_GET['code'])) {
    $params = array(
        'client_id' => OAUTH_VK_CLIENT_ID,
        'client_secret' => OAUTH_VK_SECRET,
        'code' => $_GET['code'],
        'redirect_uri' => ROOT_URL . '/login/vkontakte.php'
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        if (isset($token['email']) and $token['email']) {
            $params = array(
                'user_ids' => $token['user_id'],
                'fields' => 'uid,first_name,last_name,email',
                'access_token' => $token['access_token'],
                'v' => '5.103'
            );

            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

            auth_social('vkontakte', $token['email'], $token['access_token'], $userInfo['response'][0]['first_name'], $userInfo['response'][0]['last_name']);
        } else {
            exit('Вы запретили передать нам email');
        }
    }
} else {
    exit('400 Access denied');
}
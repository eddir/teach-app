<?php

include_once '../../../app/init.php';
include_once ROOT_APP . '/auth/google/google.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {

        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;

        dd($google_account_info);

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$google_account_info->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $stmt = $pdo->prepare("SELECT id FROM users_social WHERE parent = ? AND source = 'google'");
            $stmt->execute([$user['id']]);
            $social = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($social) {
                $pdo->prepare("UPDATE users_social SET access_token = ? WHERE id = ?")->execute([$token['access_token'], $social['id']]);
            } else {
                $pdo->prepare("INSERT INTO users_social (parent, access_token, source) VALUES (?, ?, 'google')")->
                execute([$user['id'], $token['access_token']]);
            }
        } else {
            $pdo->prepare("INSERT INTO users (email, first_name, last_name) VALUES (?, ?, ?)")->
                execute([$google_account_info->getEmail(), $google_account_info->getGivenName(), $google_account_info->getFamilyName()]);
            $pdo->prepare("INSERT INTO users_social (parent, source, access_token) VALUES (?, ?, ?)")->
                execute([$pdo->lastInsertId(), 'google', $token['access_token']]);
        }
    } else {
        exit("Hack attempt");
    }
} else {
    exit("400 Access denied");
}
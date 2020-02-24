<?php

include_once '../../app/init.php';
include_once ROOT_APP . '/auth/googleService.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {

        $gclient->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($gclient);
        $google_account_info = $google_oauth->userinfo->get();

        auth_social('google', $google_account_info->email, $token['access_token'], $google_account_info->getGivenName(), $google_account_info->getFamilyName());
    } else {
        exit("Hack attempt");
    }
} else {
    exit("400 Access denied");
}
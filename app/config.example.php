<?php

define('ROOT_APP', __DIR__);
define('ROOT_PATH', realpath(ROOT_APP . '/../'));
define('ROOT_URL', 'http://');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('OAUTH_GOOGLE_CLIENT_ID', '');
define('OAUTH_GOOGLE_SECRET', '');

define('OAUTH_VK_CLIENT_ID', '');
define('OAUTH_VK_SECRET', '');

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

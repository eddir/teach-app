<?php

define('ROOT_APP', __DIR__);
define('ROOT_PATH', realpath(ROOT_APP . '/../'));

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'rasp');
define('DB_USER', 'rasp');
define('DB_PASS', 'RWr0HxcoTBbTaDJv++');

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

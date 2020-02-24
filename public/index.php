<?php

include_once '../app/init.php';

try {
    echo $blade->run("index", ['fromLogin' => isset($_GET['fromLogin'])]);
} catch (Exception $e) {
    exit($e->getMessage());
}
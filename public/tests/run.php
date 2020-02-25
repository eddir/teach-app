<?php

include_once '../../app/init.php';

if (!isset($_GET['test_id'])) {
    header('Location: /tests');
}

try {
    echo $blade->run("tests.run");
} catch (Exception $e) {
    exit($e->getMessage());
}
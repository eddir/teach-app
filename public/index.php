<?php

include_once '../app/init.php';

try {
    echo $blade->run("hello", []);
} catch (Exception $e) {
    exit($e->getMessage());
}
<?php

include_once '../../app/init.php';

try {
    echo $blade->run("tests.add");
} catch (Exception $e) {
    exit($e->getMessage());
}
<?php

include_once '../../app/init.php';

needPermission(['guest', 'admin']);

try {
    echo $blade->run("tests.add");
} catch (Exception $e) {
    exit($e->getMessage());
}
<?php

include_once '../../app/init.php';

$stmt = $pdo->prepare('SELECT * FROM tests');
$stmt->execute();
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

try {
    echo $blade->run("tests.index", ['tests' => $tests]);
} catch (Exception $e) {
    exit($e->getMessage());
}
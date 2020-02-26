<?php

include_once '../app/init.php';

$last = array();
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare('SELECT t.id, t.description, t.title FROM tests AS t INNER JOIN (SELECT test_id FROM attempts WHERE user_id = ? ORDER BY id DESC LIMIT 5) AS a ON t.id = a.test_id');
    $stmt->execute([$_SESSION['user_id']]);
    $last = $stmt->fetchAll(PDO::FETCH_OBJ);
}

try {
    echo $blade->run("index", ['tests' => $last, 'fromLogin' => isset($_GET['fromLogin'])]);
} catch (Exception $e) {
    exit($e->getMessage());
}
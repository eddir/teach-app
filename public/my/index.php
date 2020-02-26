<?php

include_once '../../app/init.php';

needPermission(['guest', 'admin']);

$stmt = $pdo->prepare('SELECT * FROM tests WHERE author = ?');
$stmt->execute([$_SESSION['user_id']]);
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

echo $blade->run('my', ['tests' => $tests]);
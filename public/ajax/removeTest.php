<?php

require_once '../../app/init.php';

needPermission(['guest', 'admin'], true);

$pdo->prepare('DELETE FROM questions_answers WHERE parent IN(SELECT id FROM questions WHERE test = ?)')->execute([$_POST['test_id']]);
$pdo->prepare('DELETE FROM questions WHERE test = ?')->execute([$_POST['test_id']]);
$pdo->prepare('DELETE FROM tests WHERE id = ?')->execute([$_POST['test_id']]);

$stmt = $pdo->prepare('SELECT * FROM tests WHERE author = ?');
$stmt->execute([$_SESSION['user_id']]);
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

echo $blade->run('my-ajax', ['tests' => $tests]);
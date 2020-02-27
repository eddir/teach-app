<?php

require_once '../../app/init.php';

needPermission(['guest', 'admin'], true);

$pdo->prepare('DELETE FROM posts_tests WHERE post_id = ?')->execute([$_POST['post_id']]);
$pdo->prepare('DELETE FROM posts WHERE id = ?')->execute([$_POST['post_id']]);

$stmt = $pdo->prepare('SELECT * FROM posts WHERE author_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

echo $blade->run('my-post-ajax', ['posts' => $tests]);
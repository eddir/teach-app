<?php

include_once '../../app/init.php';

needPermission(['guest', 'admin']);

$stmt = $pdo->prepare('SELECT * FROM posts WHERE author_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

echo $blade->run('my-posts', ['posts' => $posts]);
<?php

include_once '../../app/init.php';

$stmt = $pdo->prepare('SELECT id, author_id, title, body FROM posts ORDER BY id DESC');
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

try {
    echo $blade->run("posts.index", ['posts' => $posts, 'fromInsertion' => (isset($_GET['fromInsertion']))]);
} catch (Exception $e) {
    exit($e->getMessage());
}

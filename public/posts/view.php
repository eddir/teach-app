<?php

include_once '../../app/init.php';

if (!isset($_GET['post_id'])) {
    header('Location: /posts/');
}

$stmt = $pdo->prepare('SELECT author_id, title, body FROM posts WHERE id = ?');
$stmt->execute([$_GET['post_id']]);
$post = $stmt->fetch(PDO::FETCH_OBJ);

if (!$post) {
    header('Location: /posts/');
}

$stmt = $pdo->prepare('SELECT id, title, description FROM tests WHERE id in (SELECT test_id FROM posts_tests WHERE post_id = ?)');
$stmt->execute([$_GET['post_id']]);
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

try {
    echo $blade->run("posts.view", ['post' => $post, 'tests' => $tests]);
} catch (Exception $e) {
    exit($e->getMessage());
}

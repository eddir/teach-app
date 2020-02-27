<?php

include_once '../../app/init.php';

needPermission(['guest', 'admin']);


$error = "";
if (isset($_POST['title'])) {
    if (isset($_POST['body'])) {
        if (strlen($_POST['title']) > 2) {
            if (strlen($_POST['title']) < 1025) {
                if (strlen($_POST['body']) > 2) {
                    if (strlen($_POST['body']) < 1025) {
                        $pdo->prepare('INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)')->execute([
                            $_SESSION['user_id'], trim($_POST['title']), trim($_POST['body'])
                        ]);

                        $post_id = $pdo->lastInsertId();
                        foreach ($_POST['test'] as $test) {
                            $pdo->prepare('INSERT INTO posts_tests (post_id, test_id) VALUES (?, ?)')->execute([$post_id, $test]);
                        }

                        header('Location: /posts/?fromInsertion=1');
                    } else {
                        $error = 'Слишком длинное тело';
                    }
                } else {
                    $error = 'Слишком короткое тело';
                }
            } else {
                $error = 'Слишком длинное название';
            }
        } else {
            $error = 'Слишком короткое название';
        }
    } else {
        $error = 'Не указано тело записи';
    }
}

$stmt = $pdo->prepare('SELECT id, title FROM tests WHERE author = ?');
$stmt->execute([$_SESSION['user_id']]);
$tests = $stmt->fetchAll(PDO::FETCH_OBJ);

try {
    echo $blade->run("posts.add", ['tests' => $tests, 'error' => $error]);
} catch (Exception $e) {
    exit($e->getMessage());
}

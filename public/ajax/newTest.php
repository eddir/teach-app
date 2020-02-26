<?php

require '../../app/init.php';

if (!isset($_POST['title']) or strlen($_POST['title']) < 3) {
    exit(json_encode(array('error' => true, 'msg' => 'Заголовок должен содержать хотя-бы 3 буквы')));
}

if (!isset($_POST['per_time']) or $_POST['title'] < 1 or $_POST['per_time'] > 50) {
    exit(json_encode(array('error' => true, 'msg' => 'Число тестов за раз должно быть от 1 до 50')));
}

$title = trim($_POST['title']);
isset($_POST['description']) ? $description = trim($_POST['description']) : null;
$per_time = (int)$_POST['per_time'];

try {
    $pdo->prepare('INSERT INTO tests (author, title, description, per_time) VALUES (?, ?, ?, ?)')->execute([1, $title, $description, $per_time]);

    $_SESSION['tests_last_inserted_id'] = $pdo->lastInsertId();
    exit(json_encode(array('error' => 0, 'msg' => 'Success', 'template' => $blade->run('tests.add-question', ['step' => 1]))));
} catch (Exception $exception) {
    exit(json_encode(array('error' => 1, 'msg' => $exception->getMessage())));
}

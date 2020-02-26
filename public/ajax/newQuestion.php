<?php

require '../../app/init.php';

needPermission(['guest', 'admin'],true);

if (!isset($_POST['question']) or strlen($_POST['question']) < 3) {
    exit(json_encode(array('error' => true, 'msg' => 'Вопрос должен содержать хотя-бы 3 буквы')));
}
if (!isset($_POST['answers']) or count($_POST['answers']) < 1) {
    exit(json_encode(array('error' => true, 'msg' => 'Должен быть хотя-бы 1 ответ')));
}

$question = trim($_POST['question']);
isset($_POST['description']) ? $description = trim($_POST['description']) : $description = null;

if (isset($_SESSION['tests_last_inserted_id'])) {
    $test_id = $_SESSION['tests_last_inserted_id'];
} else {
    exit(json_encode(array('error' => 1, 'msg' => 'Hack attempt')));
}

try {
    $pdo->prepare('INSERT INTO questions (body, description, author, test) VALUES (?, ?, ?, ?)')->execute([$question, $description, $_SESSION['user_id'], $test_id]);

    $question_id = $pdo->lastInsertId();

    foreach ($_POST['answers'] as $key => $answer) {
        $answer = trim($answer);
        if (strlen($answer) > 0) {
            $correct = 0;
            if (isset($_POST["options"][$key])) {
                $correct = 1;
            }

            $pdo->prepare('INSERT INTO questions_answers (parent, body, correct) VALUES (?, ?, ?)')->execute([$question_id, trim($answer), $correct]);
        }
    }

    exit(json_encode(array('error' => 0, 'msg' => 'Success', 'template' => $blade->run('tests.add-question', ['step' => $_POST['step'] + 1]))));
} catch (Exception $exception) {
    exit(json_encode(array('error' => 1, 'msg' => $exception->getMessage())));
}

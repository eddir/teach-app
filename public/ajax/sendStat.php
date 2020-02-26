<?php

include_once "../../app/init.php";

needPermission(['guest', 'admin'], true);

$stmt = $pdo->prepare('INSERT INTO attempts (user_id, test_id, right_answers, wrong_answers) VALUES (?, ?, ?, ?)');
$stmt->execute([$_SESSION['user_id'], $_POST['test_id'], $_POST['right_answers'], $_POST['wrong_answers']]);
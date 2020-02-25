<?php

include_once '../../app/init.php';

if (!isset($_GET['test_id'])) {
    exit(json_encode(['error' => 1, 'message' => 'Incorrect test_id']));
}

$test = trim($_GET['test_id']);

$stmt = $pdo->prepare("SELECT id FROM questions WHERE test = ?");
$stmt->execute([$test]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rands = '';

for ($i = 0; $i < 10; $i++) {
    $id = array_rand($rows);
    $rands .= $rows[$id]['id'] . ',';
    unset($rows[$id]);
}
$stmt = $pdo->prepare("SELECT id, body, description, file FROM questions WHERE id IN (".substr($rands, 0, -1).")");
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as &$question) {
    $stmt = $pdo->prepare('SELECT id, body, correct FROM questions_answers WHERE parent = ?');
    $stmt->execute([$question['id']]);
    $question['answers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    shuffle($question['answers']);
    $question['file'] !== null ? $question['image'] = 'files/' . $question['file'] : $question['image'] = null;
}

echo json_encode($questions);
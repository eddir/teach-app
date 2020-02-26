<?php

include_once "../../app/init.php";

needPermission(['guest', 'admin'], true);

$stmt = $pdo->prepare('SELECT * FROM attempts WHERE user_id = ? AND DATEDIFF(NOW(), date) < 8 ORDER BY date');
$stmt->execute([$_SESSION['user_id']]);
$attempts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = array();

$graphic = array(
    array(
        'datasets' => array(
            array(
                'label' => 'Верные ответы',
                'data' => array(),
                'fill' => false,
                'borderColor' => "rgb(0,191,165)",
                'lineTension' => 0.2
            ),
            array(
                'label' => 'Неверные ответы',
                'data' => array(),
                'fill' => false,
                'borderColor' => "rgb(221,44,0)",
                'lineTension' => 0.2
            )
        ),
        'labels' => array()
    ),
    array(
        'datasets' => array(
            array(
                'label' => 'Успешно пройденные тесты',
                'data' => array(),
                'fill' => false,
                'borderColor' => "rgba(41,98,255,1)",
                'lineTension' => 0.2
            )
        ),
        'labels' => array()
    ),
    array(
        'datasets' => array(
            array(
                'label' => 'Успешно пройденным к непройденным',
                'data' => array(),
                'fill' => false,
                'borderColor' => "rgba(255,214,0,1)",
                'lineTension' => 0.2
            )
        ),
        'labels' => array()
    ),
    array(
        'datasets' => array(
            array(
                'label' => 'Всего ответов',
                'data' => array(),
                'fill' => false,
                'borderColor' => "rgba(197,17,98,1)",
                'lineTension' => 0.2
            )
        ),
        'labels' => array()
    ),
);

$i = 0;
for ($k = 0; $k < 7; $k++) {
    if (!isset($attempts[$i + 1])) break;

    $a = 0;
    $right = 0;
    $wrong = 0;
    $passed = 0;
    $passed_test_ids = array();
    $all_test_ids = array();
    $date = explode(' ', $attempts[$i]['date'])[0];

    do {
        $a++;
        $right += $attempts[$i]['right_answers'];
        $wrong += $attempts[$i]['wrong_answers'];
        if (!array_search($attempts[$i]['test_id'], $passed_test_ids) and $right / ($right + $wrong) >= 0.75) {
            $passed_test_ids[] = $attempts[$i]['test_id'];
        }
        if (!array_search($attempts[$i]['test_id'], $all_test_ids)) {
            $all_test_ids[] = $attempts[$i]['test_id'];
        }
    } while (isset($attempts[++$i]) and explode(' ', $attempts[$i]['date'])[0] == $date);

    $graphic[0]['datasets'][0]['data'][] = $right;
    $graphic[0]['datasets'][1]['data'][] = $wrong;
    $graphic[0]['labels'][] = $date;

    $graphic[1]['datasets'][0]['data'][] = count($passed_test_ids);
    $graphic[1]['labels'][] = $date;

    $graphic[2]['datasets'][0]['data'][] = count($passed_test_ids) / count($all_test_ids);
    $graphic[2]['labels'][] = $date;

    $graphic[3]['datasets'][0]['data'][] = $a;
    $graphic[3]['labels'][] = $date;

}

exit(json_encode($graphic));
<?php

set_time_limit(0);

include_once __DIR__ . '/../../config.php';
include_once ROOT_APP . '/functions.php';
include_once 'simple_html_dom.php';

$auditories = $pdo->query('SELECT * FROM auditories')->fetchAll(PDO::FETCH_ASSOC);
$classes = $pdo->query('SELECT * FROM classes')->fetchAll(PDO::FETCH_ASSOC);
$teachers = $pdo->query('SELECT * FROM teachers')->fetchAll(PDO::FETCH_ASSOC);
$subjects = $pdo->query('SELECT * FROM subjects')->fetchAll(PDO::FETCH_ASSOC);

function updateHours($auditories, $classes, $teachers, $subjects)
{
    global $pdo;

    foreach ($classes as $class) {
        $html = str_get_html(curl('http://rasp.sstu.ru/group/' . $class['url']));

        if (!$html) {
            return $html;
        }
        $node = $html->find('.chet', 0);
        if ($node !== null) {
            foreach ($node->find('.rasp-table-col') as $day) {
                $date = explode(".", $day->find('.date', 0)->innertext());
                foreach ($day->find('.rasp-table-row') as $hour) {
                    if (($subject_title = $hour->find('.subject-m', 0))) {
                        foreach ($hour->find('.subgroup-info') as $subject_body) {
                            $subject_body->find('.teacher', 0)->has_child() ?
                                $teacher = $subject_body->find('.teacher', 0)->firstChild()->innertext() :
                                $teacher = $subject_body->find('.teacher', 0)->innertext();

                            $pdo->prepare('INSERT INTO hours (time, date, class, auditory, subject, type, teacher) VALUES (?, ?, ?, ?, ?, ?, ?)')
                                ->execute([
                                    substr(trim(preg_replace('/(<br>)|\s+/', ' ', $hour->firstChild()->innertext())), 0, 1),
                                    date("Y-{$date[1]}-{$date[0]}"),
                                    $class['id'],
                                    getParent('auditories', $auditories, $subject_body->find('.aud', 0)->innertext()),
                                    getParent('subjects', $subjects, strstr($subject_title->innertext(), '<', true)),
                                    trim(str_replace(["(", ")"], "", $subject_title->firstChild()->innertext())),
                                    getParent('teachers',$teachers, $teacher),
                                ]);
                        }
                    } else {
                        $h = $hour->children();
                        if ($h[1]->has_child()) {
                            /** @var simple_html_dom_node[] $p */
                            $p = $h[1]->firstChild()->children();
                            $p[3]->has_child() ? $teacher = $p[3]->firstChild()->firstChild()->innertext() : $teacher = $p[3]->innertext();

                            $pdo->prepare('INSERT INTO hours (time, date, class, auditory, subject, type, teacher) VALUES (?, ?, ?, ?, ?, ?, ?)')
                                ->execute([
                                    substr(trim(preg_replace('/(<br>)|\s+/', ' ', $h[0]->innertext())), 0, 1),
                                    date("Y-{$date[1]}-{$date[0]}"),
                                    $class['id'],
                                    getParent('auditories', $auditories, $p[0]->innertext()),
                                    getParent('subjects', $subjects, $p[1]->innertext()),
                                    trim(str_replace(["(", ")"], "", $p[2]->innertext)),
                                    getParent('teachers', $teachers, $teacher),
                                ]);
                        }
                    }


                }
            }
        }

        usleep(300000);
    }
    return true;
}

function updateClasses($classes)
{
    global $pdo;
    $html = str_get_html(curl('http://rasp.sstu.ru/'));

    if (!$html) {
        header('HTTP/1.1 400 Bad Request');
        exit();
    }

    $accordeon = $html->find('div[id=accordeon]', 0);

    /** @var simple_html_dom_node $fac */
    foreach (array_slice($accordeon->children(), 0, -1) as $fac) {
        $facName = trim(strstr($fac->find('.pseudo', 0)->firstChild()->innertext(), '(', true));

        /** @var simple_html_dom_node $chunk */
        foreach ($fac->find('.panel-collapse', 0)->firstChild()->children() as $chunk) {
            foreach ($chunk->find('div', 1)->children() as $child) {
                foreach ($child->find('a') as $group) {
                    $groupName = $group->innertext();
                    $url = explode("group/", $group->getAttribute('href'))[1];
                    $find = search($classes, 'name', $groupName);

                    if ($find === null) {
                        try {
                            $stmt = $pdo->prepare('INSERT INTO classes (name, faculty, url) VALUES (?, ?, ?)');
                            $stmt->execute([$groupName, $facName, $url]);
                            $classes[] = [
                                'id' => $pdo->lastInsertId(),
                                'name' => $groupName,
                                'faculty' => $facName,
                                'url' => $group->getAttribute('href')
                            ];
                        } catch (Exception $error) {
                            echo $error->getMessage(), "<br>";
                        }
                    } elseif ($url != $classes[$find]['url']) {
                        $classes[$find]['url'] = $url;
                        try {
                            $stmt = $pdo->prepare('UPDATE classes SET url = ? WHERE id = ?');
                            $stmt->execute([$url, $classes[$find]['id']]);
                        } catch (Exception $error) {
                            echo $error->getMessage(), "<br>";
                        }
                    }
                }
            }
        }
    }

    return $classes;
}
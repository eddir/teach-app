<?php

include_once 'starter.php';

/*
 * @var array $auditories
 * @var array $classes
 * @var array $teachers
 */

$start = microtime(true);

updateHours($auditories, $classes, $teachers, $subjects);

echo "Success. ", (microtime(true) - $start), " seconds.";
<?php

include_once 'starter.php';

/*
 * @var array $auditories
 * @var array $classes
 * @var array $teachers
 */

$classes = updateClasses($classes);

if (count($classes) > 0)
    echo "Success";
else
    echo "Fail";
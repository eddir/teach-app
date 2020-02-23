<?php

use eftec\bladeone\BladeOne;

include_once 'config.php';
include_once 'functions.php';

include ROOT_APP . "/modules/BladeOne/lib/BladeOne.php";
$blade = new BladeOne(ROOT_APP . '/views',ROOT_APP . '/cache', BladeOne::MODE_DEBUG);
$blade->setIsCompiled(false);
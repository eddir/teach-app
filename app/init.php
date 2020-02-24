<?php

use eftec\bladeone\BladeOne;

include_once 'config.php';
include_once 'functions.php';
include_once "auth/auth.php";

include ROOT_APP . "/modules/BladeOne/lib/BladeOne.php";
$blade = new BladeOne(ROOT_PATH . '/views',ROOT_PATH . '/cache', BladeOne::MODE_DEBUG);
$blade->setIsCompiled(false);
<?php

include_once "../../app/init.php";

needPermission(['guest', 'admin']);

echo $blade->run('stat', []);
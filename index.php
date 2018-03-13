<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/autoload.php';

$ctrl = 'Comments';
$act = 'Create';
$fullCtrlName = '\App\Controllers\\'.$ctrl;
$controller = new $fullCtrlName;
$controller->action($act);
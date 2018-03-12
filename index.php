<?php

require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/boot.php';
require __DIR__ . '/autoload.php';

//$ctrl = $_GET['ctrl'] ?: 'Index';
//$act = $_GET['act'] ?: 'Index';

$ctrl = 'Comments';
$act = 'Create';
$fullCtrlName = '\App\Controllers\\'.$ctrl;
$controller = new $fullCtrlName;
$controller->action($act);
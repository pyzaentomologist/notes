<?php

declare(strict_types=1);

namespace App;

require_once('./src/Utils/debug.php');
require_once('./src/View.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$view = new View();

$vievParams=[];
if($action ==='create'){
 $page = 'create';
 $vievParams['resultCreate'] = 'udało się';
} else {
 $page = 'list';
 $vievParams['resultList'] = 'wyświetlam listę';
}

$view->render($page, $vievParams);


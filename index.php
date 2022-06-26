<?php

declare(strict_types=1);

namespace App;

require_once('./src/Utils/debug.php');
require_once('./src/View.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$view = new View();

$vievParams=[];

switch ($action){
 case 'create':
  $page = 'create';
  $created=false;

  if(!empty($_POST)){
   $created=true;
   $vievParams = [
     'title'=> $_POST['title'],
     'description' => $_POST['description']
   ];
  }
  $vievParams['created'] = $created;
 break;

 default:
  $page = 'list';
  $vievParams['resultList'] = 'wyświetlam listę';
 break;
}

$view->render($page, $vievParams);


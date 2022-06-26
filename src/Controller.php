<?php 
declare(strict_types=1);

namespace App;

require_once('./src/View.php');

class Controller
{
 private const DEFAULT_ACTION = 'list';

 private array $getData;
 private array $postData;

 public function __construct(array $getData, array $postData)
 {
 $this->getData = $getData;
 $this->postData = $postData;

 }

 public function run(): void
 {

 $action = $this->getData['action'] ?? self::DEFAULT_ACTION;

 $view = new View();
 $vievParams = [];

 switch ($action){
  case 'create':
   $page = 'create';
   $created=false;
   if(!empty($this->postData)){
    $created=true;
    $vievParams = [
     'title'=> $this->postData['title'],
       'description' => $this->postData['description']
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
 }
}
 
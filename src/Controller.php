<?php 
declare(strict_types=1);

namespace App;

use App\Exception\ConfigurationException;

require_once('./src/Database.php');
require_once('./src/View.php');
require_once('./src/Exception/ConfigurationException.php');

class Controller
{
 private const DEFAULT_ACTION = 'list';
 
 private static array $configuration = [];

 private Database $database;
 private array $request;
 private View $view;
 
public static function initConfiguration(array $configuration): void
{
  self::$configuration = $configuration;
}

 public function __construct(array $request)
 {
  if(empty(self::$configuration['db'])){
    throw new ConfigurationException('Configuration error!!!');
  }
  $this->database = new Database(self::$configuration['db']);
  $this->request = $request;
  $this->view = new View();
}

 public function run(): void
 {

 $viewParams = [];

 switch ($this->action()){
  case 'create':
   $page = 'create';

   $data = $this->getRequestPost();
   if(!empty($data)){
    $database = [
      'title' => $data['title'],
      'description' => $data['description']
    ];
    $this->database->createNote($database);
    header('Location: /?before=created');
    
    }
  break;

  default:
    $page = 'list';

    $data = $this->getRequestGet();

    $notes = $this->database->getNotes();
    dump($notes);


    $viewParams['before'] = $data['before'] ?? null;
    break;
  }
  $this->view->render($page, $viewParams);
 }
 

 private function action(): string
 {
  $data = $this->getRequestGet();
  return $data['action'] ?? self::DEFAULT_ACTION;
 }

 private function getRequestGet(): array
 {
  return $this->request['get'] ?? [];
 }

 private function getRequestPost(): array
 {
  return $this->request['post'] ?? [];
 }
}
 
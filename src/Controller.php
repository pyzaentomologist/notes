<?php 
declare(strict_types=1);

namespace App;

use App\Request;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;

require_once('./src/Database.php');
require_once('./src/View.php');
require_once('./src/Exception/ConfigurationException.php');

class Controller
{
  private const DEFAULT_ACTION = 'list';
  
  private static array $configuration = [];

  private Database $database;
  private Request $request;
  private View $view;
  
  public static function initConfiguration(array $configuration): void
  {
    self::$configuration = $configuration;
  }

  public function __construct(Request $request)
  {
    if(empty(self::$configuration['db'])){
      throw new ConfigurationException('Configuration error!!!');
    }
    $this->database = new Database(self::$configuration['db']);
    $this->request = $request;
    $this->view = new View();
  }
  public function createAction()
  {
    if($this->request->hasPost()){
      $noteData = [
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description'),
      ];
      $this->database->createNote($noteData);
      header('Location: /?before=created');
      exit;
      
      }
      $this->view->render('create');
  }

  public function showAction()
  {
    $noteId = (int) $this->request->getParam('id');
    if(!$noteId){
      header('Location: /?error=missingNoteId');
      exit;
    }

    try{
      $note = $this->database->getNote($noteId);
    } catch(NotFoundException $e) {
      header('Location: /?error=noteNotFound');
      exit;
    }

   
    $viewParams = [
      'note' => $note
    ];
    $this->view->render('show', $viewParams ?? []);

  }

  public function listAction()
  {
    $viewParams = [
      'notes' => $this->database->getNotes(),
      'before' => $this->request->getParam('before'),
      'error' => $this->request->getParam('error')
    ];
    $this->view->render('list', $viewParams ?? []);

  }


  public function run(): void
  {
   $action = $this->action() . 'Actionsss';
   if(!method_exists($this, $action)){
    $action = self::DEFAULT_ACTION . 'Action';
  }
  $this->$action();
  }
  

  private function action(): string
  {
   return $this->request->getParam('action', self::DEFAULT_ACTION);
  }

}
 
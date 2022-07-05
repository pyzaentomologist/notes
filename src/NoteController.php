<?php 
declare(strict_types=1);

namespace App;

use App\AbstractController;
use App\Exception\NotFoundException;

require_once('./src/AbstractController.php');

class NoteController extends AbstractController
{
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


}
 
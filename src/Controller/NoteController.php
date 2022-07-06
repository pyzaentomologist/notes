<?php 
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractController;
use App\Exception\NotFoundException;

class NoteController extends AbstractController
{
  public function createAction():void
  {
    if($this->request->hasPost()){
      $noteData = [
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description'),
      ];
      $this->database->createNote($noteData);

      $this->redirect('/', ['before' => 'created']);
      
      }
      $this->view->render('create');
  }

  public function showAction():void
  {
    $noteId = (int) $this->request->getParam('id');
    if(!$noteId){
      $this->redirect('/', ['error' => 'missingNoteId']);
    }

    try{
      $note = $this->database->getNote($noteId);
    } catch(NotFoundException $e) {
      $this->redirect('/', ['error' => 'noteNotFound']);
    }

   
    $viewParams = [
      'note' => $note
    ];
    $this->view->render('show', $viewParams ?? []);

  }

  public function listAction():void
  {
    $viewParams = [
      'notes' => $this->database->getNotes(),
      'before' => $this->request->getParam('before'),
      'error' => $this->request->getParam('error')
    ];
    $this->view->render('list', $viewParams ?? []);

  }

  public function editAction():void
  {
    $noteId = (int) $this->request->getParam(('id'));
    if(!$noteId) {
      $this->redirect('/', ['error' => 'missingNoteId']);
    }
    $this->view->render(
      'edit'
    );
  }

}
 
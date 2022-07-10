<?php 
declare(strict_types=1);

namespace App\Controller;


class NoteController extends AbstractController
{
  private const PAGE_SIZE = 10;
  public function createAction(): void
  {
    if($this->request->hasPost()){
      $noteData = [
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description'),
      ];
      $this->noteModel->create($noteData);

      $this->redirect('/', ['before' => 'created']);
      
      }
      $this->view->render('create');
  }

  public function showAction(): void
  {
   
    $note = $this->getNote();   
    
    $this->view->render(
      'show',
      ['note' => $note]
    );

  }

  public function listAction(): void
  {
    $phrase = $this->request->getParam('phrase');
    $date = $this->request->getParam('date');
    $pageNumber = (int) $this->request->getParam('page', 1);
    $pageSize = (int) $this->request->getParam('pagesize', self::PAGE_SIZE);
    $sortBy = $this->request->getParam('sortby', 'title');
    $sortOrder = $this->request->getParam('sortorder', 'desc');

    if (!in_array($pageSize, [1, 5, 10, 25])) {
      $pageSize = self::PAGE_SIZE;
    }

    if ($phrase || $date) {
      $noteList = $this->noteModel->search($phrase, $date, $pageNumber, $pageSize, $sortBy, $sortOrder);
      $notes = $this->noteModel->searchCount($phrase, $date);

    } else {
      $noteList = $this->noteModel->list($pageNumber, $pageSize, $sortBy, $sortOrder);
      $notes = $this->noteModel->count();
    }


    if(!$notes){
      if(!$phrase){
        $this->redirect('/', ['exception' => 'date']);
      } else if (!$date){
        $this->redirect('/', ['exception' => 'phrase']);
      } else {
        $this->redirect('/', ['exception' => 'phraseDate']);
      }
    }

    $this->view->render(
      'list',
      [
        'page' => [
          'number' => $pageNumber, 
          'size' => $pageSize,
          'pages' => (int) ceil($notes/$pageSize)
        ],
        'phrase' => $phrase,
        'date' => $date,
        'sort' => ['by' => $sortBy, 'order' => $sortOrder],
        'notes' => $noteList,
        'before' => $this->request->getParam('before'),
        'exception' => $this->request->getParam('exception'),
        'error' => $this->request->getParam('error')
      ]
    );
  }

  public function editAction(): void
  {
    if ($this->request->isPost()) {
      $noteId = (int) $this->request->postParam('id');
      $noteData = [
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description')
      ];
      $this->noteModel->edit($noteId, $noteData);
      $this->redirect('/', ['before' => 'edited']);
    }

   
    $note = $this->getNote();

    $this->view->render('edit', ['note' => $note]);
  }

  public function deleteAction(): void
  {

    if ($this->request->isPost()) {
      $noteId = (int) $this->request->postParam('id');
      $this->noteModel->delete($noteId);
      $this->redirect('/', ['before' => 'deleted']);
    }
    $note = $this->getNote();   
    
    $this->view->render(
      'delete',
      ['note' => $note]
    );
  }

  final private function getNote(): array
  {
    $noteId = (int) $this->request->getParam('id');

    if (!$noteId) {
      $this->redirect('/', ['error' => 'missingNoteId']);
    }

    return $this->noteModel->get($noteId);
    
  }
}
 
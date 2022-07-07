<div class="list">
  <section>
   <div class="message">
     <?php if(!empty($params['before'])) {
       switch ($params['before']) {
          case 'created':
            echo 'Notatka została utworzona!!!';
            break;
          case 'edited':
            echo 'Notatka została edytowana';
            break;
          case 'deleted':
            echo 'Notatka została usunięta';
            break;
       }
     }
     ?>
   
   </div>
   
   <div class="error">
     <?php if(!empty($params['error'])) {
       switch($params['error']){
        case 'missingNoteId':
          echo 'Niepoprawny identyfikator notatki';
          break;
         case 'noteNotFound':
         echo 'Notatka nie została znaleziona';
           break;
       }
     }
     ?>
   
   </div>
   <div class=tbl-header>
     <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Tytuł</th>
          <th>Data utworzenia</th>
          <th>Opcje</th>
        </tr>
      </thead>
     </table>
   </div>
     <div class="tbl-content">
      <table>
        <tbody>
          <?php foreach ($params['notes'] ?? [] as $note) :?>
            <tr>
              <td><?php echo  $note['id'] ?></td>
              <td><?php echo $note['title'] ?></td>
              <td><?php echo $note['created'] ?></td>
              <td>
                <a href="/?action=show&id=<?php echo $note['id'] ?>" class="button">Szczegóły</a>
                <a href="/?action=delete&id=<?php echo $note['id'] ?>" class="button">Usuń</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
     </div>
  </section>
</div>
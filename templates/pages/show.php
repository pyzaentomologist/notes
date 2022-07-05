<div class="show">
 <?php $note = $params['note'] ?? null; ?>
 <?php if($note): ?>
 <ul>
  <li>Id: <?php echo $note['id'] ?></li>
  <li>Treść: <?php echo $note['title'] ?></li>
  <li><?php echo $note['description'] ?></li>
  <li>Utworzono: <?php echo $note['created'] ?></li>
 </ul>
 <?php else: ?>
  <div>
   Brak notatki do wyświetlenia
  </div>
  <?php endif; ?>
  <a href="/" class="button">
   Powrót do menu
  </a>
</div>
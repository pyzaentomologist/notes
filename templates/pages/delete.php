<div class="show">
 <?php $note = $params['note'] ?? null; ?>
 <?php if($note): ?>
 <ul>
  <li>Id: <?php echo $note['id'] ?></li>
  <li>Treść: <?php echo $note['title'] ?></li>
  <li><?php echo $note['description'] ?></li>
  <li>Utworzono: <?php echo $note['created'] ?></li>
</ul>
<form method="POST" action="/?action=delete">
 <input name="id" type="hidden" value="<?php echo $note['id'] ?>">
 <input type="submit" value="Usuń">
</form>
<?php else: ?>
  <div>
    Brak notatki do wyświetlenia
  </div>
  <?php endif; ?>
  <a href="/" class="button">
   Powrót do menu
  </a>
</div>
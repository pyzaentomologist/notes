<div>
  <h3>Edytuj notatkę</h3>
  <div>
    <?php $note = $params['note'] ?>
      <form class="note-form" action="/?action=edit" method="post">
        <input name="id" type="hidden" value="<?php echo $note['id']?>">
        <ul>
          <li><label>Tytuł <span class="required">*</span></label><input type="text" name="title" class="field-long" value="<?php echo $note['title'] ?>" required></li>
          <li><label>Treść</label><textarea name="description" id="fiels5" class="field-long field-textarea"><?php echo $note['description'] ?></textarea></li>
          <li><input type="submit" value="Zatwierdź"></li>
        </ul>
      </form>
  </div>
</div>

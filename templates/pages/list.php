<div class="list">
  <section>
   <div class="message">
     <?php if(!empty($params['before'])) {
       switch($params['before']){
         case 'created':
         echo 'Notatka została utworzona!!!';
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
          <th>Opcje</th>
        </tr>
      </thead>
     </table>
   </div>
     <div class="tbl-content">
      <table>
        <tbody>
          
        </tbody>
      </table>
     </div>
  </section>
</div>
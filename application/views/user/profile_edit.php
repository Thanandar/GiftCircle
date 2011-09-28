<div class="span16">

<?php
$form = new Appform();
if(isset($errors)) {
   $form->errors = $errors;
}
if(isset($data)) {
   unset($data['password']);
   $form->values = $data;
}
echo $form->open('user/profile_edit');
?>

   <ul>
      <li><label><?php echo __('Firstname'); ?></label></li>
      <?php echo $form->input('firstname'); ?>
      <li><label><?php echo __('Surname'); ?></label></li>
      <?php echo $form->input('surname'); ?>
      <li><label><?php echo __('Email address'); ?></label></li>
      <?php echo $form->input('email') ?>
      <li><label><?php echo __('Password'); ?></label></li>
      <?php echo $form->password('password', null, array('info' => __('Password should be between 6-42 characters.'))) ?>
      <li><label><?php echo __('Re-type Password'); ?></label></li>
      <?php echo $form->password('password_confirm') ?>
      

      <?php /*
      <li><h2><?php echo __('Roles'); ?></h2></li>
      <table class="content">
         <tr class="heading"><td><?php echo __('Role'); ?></td><td><?php echo __('Description'); ?></td></tr>
     <?php
         $i = 0;
         foreach($user_roles as $role => $description) {
            echo '<tr';
            if($i % 2 == 0) {
               echo ' class="odd"';
            }
            echo '>';
            echo '<td>'.ucfirst($role).'</td><td>'.$description.'</td>';
            echo '</tr>';
            $i++;
         }
      ?>
            </table> */ ?>
   </ul>
   <div class="actions">
      <input type="submit" class="btn primary large" value="Update" />
   </div>
<?php
echo $form->close();
?>

</div>

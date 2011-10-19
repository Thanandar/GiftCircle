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


   <div class="clearfix">
      <label>First name</label>
      <div class="input"><?php echo $form->input('firstname', null, array(
         'required' => 'required',
)); ?></div>
   </div>
   <div class="clearfix">
      <label>Surname</label>
      <div class="input"><?php echo $form->input('surname', null, array(
         'required' => 'required',
)); ?></div>
   </div>

   <div class="clearfix<?php if (isset($errors['email']) || isset($errors['username'])) echo ' error'; ?>">
      <label>Email address</label>
      <div class="input"><?php echo $form->input('email', null, array(
         'type' => 'email',
         'placeholder' => 'you@example.com',
         'required' => 'required',
)); ?></div>
   </div>   

   <div class="clearfix<?php if (isset($errors['password'])) echo ' error'; ?>">
      <label>Password</label>
      <div class="input">
         <?php echo $form->password('password', null, array(
)); ?>
         <?php if (!isset($errors['password'])) { ?>
         <?php } ?>
      </div>
   </div>   

   <div class="clearfix<?php if (isset($errors['password_confirm'])) echo ' error'; ?>">
      <label>Confirm password</label>
      <div class="input">
         <?php echo $form->password('password_confirm', null, array(
)); ?>
      </div>
   </div>   


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
   
   <div class="actions">
      <input type="submit" class="btn primary large" value="Update" />
   </div>
<?php
echo $form->close();
?>

</div>

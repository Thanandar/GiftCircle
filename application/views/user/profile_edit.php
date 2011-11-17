<div class="span12">

<a class="danger pull-right" href="/user/unregister">Delete your account</a>

<?php
$form = new Appform();
if(isset($errors)) {
   $form->errors = $errors;
}
if(isset($data)) {
   unset($data['password']);
   $data['dob'] = strtotime($data['dob']);
   $data['dob'] = $data['dob'] ? date('d/m/Y', $data['dob']) : '';
   $form->values = $data;
}
echo $form->open('user/profile_edit');;
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

   <div class="clearfix<?php if (isset($errors['dob']) || isset($errors['dob'])) echo ' error'; ?>">
      <label>Date of birth</label>
      <div class="input">
         <?php echo $form->input('dob', null, array(
         'type' => 'date',
         'placeholder' => '31/12/1999',
         'pattern' => '^\d+/\d+/\d\d\d\d$',
         )); ?>
         <span class="help-inline">Optional (dd/mm/yyyy)</span>
      </div>
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

   <div class="clearfix<?php if (isset($errors['password_confirm'])) echo ' error'; ?>">
      <div class="input">
         <ul class="inputs-list">
            <li>
               <label>
                  <input type="checkbox" name="marketing" value="1" <?php echo $data['marketing'] ? ' checked="checked" ':''; ?> />
                  Receive marketing communication via email
               </label>
            </li>
         </ul>
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
      <input type="submit" class="btn primary" value="Update your profile" />
      or <a href="/">cancel</a>
   </div>
<?php
echo $form->close();
?>

</div>

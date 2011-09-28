<div class="span12">

	<p>Already have a user account? <a href="/user/login">Log in here</a>.</p>

<?php
$form = new Appform();
if(isset($errors)) {
	$form->errors = $errors;
}
if(isset($defaults)) {
	$form->defaults = $defaults;
} else {
	unset($_POST['password']);
	unset($_POST['password_confirmation']);
	$form->defaults = $_POST;
}
echo $form->open('');
?>


<fieldset>

   <div class="clearfix">
      <label>First name</label>
      <div class="input"><?php echo $form->input('firstname'); ?></div>
   </div>
   <div class="clearfix">
      <label>Surname</label>
      <div class="input"><?php echo $form->input('surname'); ?></div>
   </div>

   <div class="clearfix<?php if (isset($errors['email']) || isset($errors['username'])) echo ' error'; ?>">
      <label>Email address</label>
      <div class="input"><?php echo $form->input('email'); ?></div>
   </div>   

   <div class="clearfix<?php if (isset($errors['password'])) echo ' error'; ?>">
      <label>Password</label>
      <div class="input">
         <?php echo $form->password('password'); ?>
         <?php if (!isset($errors['password'])) { ?>
         <span class="help-inline">Password must be at least 6 characters long</span>
         <?php } ?>
      </div>
   </div>   

	<div class="clearfix<?php if (isset($errors['password_confirm'])) echo ' error'; ?>">
		<label>Confirm password</label>
		<div class="input">
			<?php echo $form->password('password_confirm'); ?>
		</div>
	</div>	

   <div class="clearfix">
      <label>Terms &amp; Conditions</label>
      <div class="input">
         <ul class="inputs-list">
            <li><label>
               <input type="checkbox" value="accept" />
               <span>Accept</span>
            </label></li>
         </ul>
      </div>
   </div>

	<?php if(isset($captcha_enabled) && $captcha_enabled) { ?>
		 <?php echo $recaptcha_html; ?>
	<?php } ?>

   <?php
   if (!empty($errors)) {
      echo '<div class="xalert-message xerror"><pre>';
      print_r($errors);
      echo '</pre></div>';
   }
   ?>


   <div class="actions">
      <input type="submit" value="Create my account" class="btn primary large" />
   </div>



</fieldset>
<?php
echo $form->close();
?>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/testimonials'); ?>
</div>



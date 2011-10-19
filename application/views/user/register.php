<div class="span12">

	<p>Already have a user account? <a href="/user/login">Log in here</a>.</p>

<?php

if (@$_GET['firstname'] && !@$_POST['firstname']) {
   $_POST['firstname'] = $_GET['firstname'];
}
if (@$_GET['surname'] && !@$_POST['surname']) {
   $_POST['surname'] = $_GET['surname'];
}
if (@$_GET['email'] && !@$_POST['email']) {
   $_POST['email'] = $_GET['email'];
}


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
         'required' => 'required',
)); ?>
         <?php if (!isset($errors['password'])) { ?>
         <?php } ?>
      </div>
   </div>   

	<div class="clearfix<?php if (isset($errors['password_confirm'])) echo ' error'; ?>">
		<label>Confirm password</label>
		<div class="input">
			<?php echo $form->password('password_confirm', null, array(
         'required' => 'required',
         'oninput' => "if(this.setCustomValidity)this.setCustomValidity((this.value != $('#password').val())?'Please enter a matching password.':'')",
)); ?>
		</div>
	</div>	

<!--    <div class="clearfix">
      <label>Terms &amp; Conditions</label>
      <div class="input">
         <ul class="inputs-list">
            <li><label>
               <input type="checkbox" value="accept" name="terms" />
               <span>Accept</span>
            </label></li>
         </ul>
      </div>
   </div> -->

	<?php if(isset($captcha_enabled) && $captcha_enabled) { ?>
		 <?php echo $recaptcha_html; ?>
	<?php } ?>


   <div class="actions">
      <button type="submit" class="btn primary large" >Create your account</button>
   </div>



</fieldset>
<?php
echo $form->close();
?>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/testimonials'); ?>
</div>



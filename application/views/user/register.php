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
         'autofocus' => 'autofocus',
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
         'placeholder' => '31/12/1980',
         'pattern' => '^\d+/\d+/\d\d\d\d$',
         )); ?>
         <span class="help-inline">Optional (dd/mm/yyyy)</span>
      </div>
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

   <div class="clearfix<?php if (isset($errors['password_confirm'])) echo ' error'; ?>">
      <div class="input">
         <ul class="inputs-list">
            <li>
               <label>
                  <input type="checkbox" name="marketing" value="1" <?php echo @$_POST['marketing'] ? ' checked="checked" ':''; ?> />
                  I'm happy to receive the Gift Circle email newsletter <br />featuring new retailers, offers and services.
               </label>
            </li>
         </ul>
      </div>
   </div>   


    <div class="clearfix">
      <div class="input">
         <ul class="inputs-list">
            <li><label>
               <input required="required" type="checkbox" value="accept" name="terms" />
               <span>Accept</span> <a href="/home/terms" target="_blank">Gift Circle Terms &amp; Conditions</a>
            </label></li>
         </ul>
      </div>
   </div>

	<?php if(isset($captcha_enabled) && $captcha_enabled) { ?>
		 <?php echo $recaptcha_html; ?>
	<?php } ?>


   <div class="actions">
      <button type="submit" class="btn primary" >Create your account</button>
   </div>



</fieldset>
<?php
echo $form->close();
?>
</div>

<div class="span4">
<h3>Welcome</h3>
<p>Thanks for signing up with Gift Circle. You may be here because you need to get your gift shopping organised and need to ask a few people what they want or someone's asked you for a list of gifts you'd like – lucky you!</p>
<p>Whichever it is we're glad you're here and hope you will invite lots of people to join you. </p>
<p>If you have any comments or suggestions please let us know at <a href="mailto:feedback@giftcircle.co.uk">feedback@giftcircle.co.uk</a></p>
<p>Enjoy!</p>


</div>


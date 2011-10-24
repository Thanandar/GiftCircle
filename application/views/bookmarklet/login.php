<?php
$form = new Appform();
if(isset($errors)) {
	//$form->errors = $errors;
}
if(isset($username)) {
	$form->values['username'] = $username;
}
// set custom classes to get labels moved to bottom:
$form->error_class = 'error block';
$form->info_class = 'info block';
?>
<div class="span11">

	<p>Log in to Gift Circle to add this gift<p>

	<?php
	if (!empty($errors['password'])) {
		echo '<div class="alert-message error"><p>';
		echo $errors['password'];
		echo '</p></div>';
	}
	?>
	<form method="post" action="" accept-charset="utf-8">
		<fieldset>
			<div class="clearfix">
				<?php echo $form->label('username', __('Email')); ?>
				<div class="input">
					<?php 
					echo $form->input('username', null, array(
						'type' => 'email',
						'required' => 'required',
						'placeholder' => 'you@example.com',
					)); 
					?>
				</div>
			</div>			

			<div class="clearfix">
				<?php echo $form->label('password', __('Password')); ?>
				<div class="input">
					<?php 
					echo $form->password('password', null, array(
						'required' => 'required',
					)); 
					?>
					<span class="help-inline"><?php echo Html::anchor('user/forgot', __('Forgot your password?')); ?></span>
				</div>
			</div>			


<!--<?php


$authClass = new ReflectionClass(get_class(Auth::instance()));
if($authClass->hasMethod('auto_login')) {
	?>
			<div class="clearfix">
				<div class="input">
					<ul class="inputs-list">
						<li>
							<label>
								<input type="checkbox" name="remember" value="remember" />
								<span>Remember me</span>
							</label>
						</li>
					</ul>
				</div>
			</div>	
	<?php
}
?>-->
			<div class="actions">
				<input type="submit" value="Login" class="btn primary large" />
			</div>

</form>
<?php

$options = array_filter(Kohana::$config->load('useradmin.providers'));
if(!empty($options)) {
	?><h3>To register / log in using another account, please click your provider</h3><?php
	if(isset($options['facebook']) && $options['facebook']) {
		echo '<a class="login_provider" style="background: #FFF url(/img/facebook.png) no-repeat center center" href="'.URL::site('/user/provider/facebook').'">Facebook</a>';
	}
	if(isset($options['twitter']) && $options['twitter']) {
		echo '<a class="login_provider" style="background: #FFF url(/img/twitter.png) no-repeat center center" href="'.URL::site('/user/provider/twitter').'">Twitter</a>';
	}
	if(isset($options['google']) && $options['google']) {
		echo '<a class="login_provider" style="background: #FFF url(/img/google.gif) no-repeat center center" href="'.URL::site('/user/provider/google').'">Google</a>';
	}
	if(isset($options['yahoo']) && $options['yahoo']) {
		echo '<a class="login_provider" style="background: #FFF url(/img/yahoo.gif) no-repeat center center" href="'.URL::site('/user/provider/yahoo').'">Yahoo</a>';
	}
}
?>

</div>

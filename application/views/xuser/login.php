


<div class="span12">

	<form method="post">
		<fieldset>
			<legend>Login</legend>
			<div class="clearfix">
				<label>Email</label>
				<div class="input"><input name="email"></div>
			</div>
			<div class="clearfix">
				<label>Password</label>
				<div class="input"><input name="password" type="password"></div>
			</div>

			<?php
			if (!empty($errors)) {
				echo '<div class="alert-message error"><p>';
				echo $errors;
				echo '</p></div>';
			}
			?>

			<div class="actions">
				<input type="submit" value="Login" class="btn primary large" />
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/testimonials'); ?>
</div>


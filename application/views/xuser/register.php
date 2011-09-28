
<div class="span12">

	<form method="post">
		<fieldset>
			<legend>Register</legend>
			<div class="clearfix">
				<label>First name</label>
				<div class="input"><input name="firsname"></div>
			</div>
			<div class="clearfix">
				<label>Surname</label>
				<div class="input"><input name="surname"></div>
			</div>
			<div class="clearfix">
				<label>Email</label>
				<div class="input">
					<input name="email">
					<span class="help-inline">This will be your username</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Password</label>
				<div class="input"><input name="password" type="password"></div>
			</div>
			<div class="clearfix">
				<label>Confirm password</label>
				<div class="input"><input name="confirm" type="password"></div>
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


			<?php
			if (!empty($errors)) {
				echo '<div class="alert-message error"><p>';
				echo $errors;
				echo '</p></div>';
			}
			?>

			<div class="actions">
				<input type="submit" value="Create my account" class="btn primary large" />
			</div>
		</fieldset>
	</form>
</div>
<div class="span4">
	<?php echo View::factory('sidebar/testimonials'); ?>
</div>



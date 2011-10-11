
<div class="span12">

	<h2>Edit friend "<?php echo HTML::chars($friend->firstname.' '.$friend->surname) ?>"</h2>



	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label>First name: </label>
				<div class="input"><input name="firstname" value="<?php echo HTML::chars($friend->firstname) ?>"></div>
			</div>
			<div class="clearfix">
				<label>Surname: </label>
				<div class="input"><input name="surname" value="<?php echo HTML::chars($friend->surname) ?>"></div>
			</div>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Email: </label>
				<div class="input">
					<input name="email" value="<?php echo HTML::chars($friend->email) ?>" />
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Birthday: </label>
				<div class="input" value="<?php echo HTML::chars($friend->birthday) ?>"><input name="birthday" value="<?php echo HTML::chars($friend->birthday) ?>"></div>
			</div>			
			<div class="clearfix">
				<label>Address: </label>
				<div class="input"><textarea name="address"><?php echo HTML::chars($friend->address) ?></textarea></div>
			</div>			


			<div class="actions">
				<input type="submit" value="Update details" class="btn primary" /> or
				<a href="/friend/list">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<h2><?php echo Message::e('shopping', 'my-list') ?></h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
</div>




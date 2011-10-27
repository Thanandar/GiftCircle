
<div class="span12">

	<a class="danger pull-right" href="/friend/delete/<?php echo $friend->id; ?>">Delete this friend</a>
	
	<h2><?php echo HTML::chars($friend->firstname.' '.$friend->surname) ?></h2>


	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label>First name: </label>
				<div class="input"><input name="firstname" value="<?php echo HTML::chars($friend->firstname) ?>"></div>
			</div>
			<div class="clearfix">
				<label>Surname: </label>
				<div class="input">
					<input name="surname" value="<?php echo HTML::chars($friend->surname) ?>">
					<span class="help-inline">Optional</span>
				</div>
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
				<div class="input" value="<?php echo HTML::chars($friend->birthday) ?>">
					<input name="birthday" value="<?php echo HTML::chars($friend->birthday) ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>			
			<div class="clearfix">
				<label>Address: </label>
				<div class="input">
					<textarea name="address"><?php echo HTML::chars($friend->address) ?></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>			


			<div class="actions">
				<input type="submit" value="Update your friend" class="btn primary" /> or
				<a href="/friend/list">cancel</a>
			</div>
		</fieldset>
	</form>
</div>





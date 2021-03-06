

<div class="span12">
	<form method="post">

	<a class="danger pull-right" href="/friend/delete/<?php echo $friend->id; ?>">Delete this friend</a>
	
			<div class="clearfix<?php if (!empty($errors['firstname'])) {echo ' error';} ?>">
				<label>First name: </label>
				<div class="input">
					<input name="firstname" value="<?php echo HTML::chars($friend->firstname) ?>">
					<?php if (!empty($errors['firstname'])) {
						echo '<span class="help-inline">' . $errors['firstname'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Surname: </label>
				<div class="input">
					<input name="surname" value="<?php echo HTML::chars($friend->surname) ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix<?php if (!empty($errors['email'])) {echo ' error';} ?>">
				<label>Email: </label>
				<div class="input">
					<input name="email" value="<?php echo HTML::chars($friend->email) ?>" />
					<?php if (!empty($errors['email'])) {
						echo '<span class="help-inline">' . $errors['email'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Date of birth: </label>
				<div class="input" value="<?php echo HTML::chars($friend->birthday) ?>">
					<input name="birthday" value="<?php echo HTML::chars($friend->birthday) ?>" placeholder="eg '25/12/1980'">
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
	</form>
</div>





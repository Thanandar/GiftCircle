
<div class="span12">

	<form method="post">
		<fieldset>
			<legend>Add a friend</legend>
			<div class="clearfix">
				<label>Choose friends to add</label>
				<div class="input">
					<ul class="inputs-list">
						<li><label><input type="checkbox" name="id[]" value="1" /> <span>Select everyone</span></label></li>
						<li><label><input type="checkbox" name="id[]" value="1" /> <span>Tom</span></label></li>
						<li><label><input type="checkbox" name="id[]" value="1" /> <span>Dick</span></label></li>
						<li><label><input type="checkbox" name="id[]" value="1" /> <span>Harry</span></label></li>
					</ul>
					<span class="help-block">
						Ass soon as you've confirmed your new list,
						we'll email these guys to invite them to see it
					</span>
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
				<input name="submit" type="submit" value="Add friends" class="btn primary large" /> or
				<a href="/list/mine/2">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>





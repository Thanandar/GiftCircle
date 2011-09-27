
<div class="span12">

	<form method="post">
		<fieldset>
			<legend>Create a list</legend>
			<div class="clearfix">
				<label>Name your gift list</label>
				<div class="input"><input name="name" placeholder="List name, eg '30th Birthday'"></div>
			</div>
			<div class="clearfix">
				<label>Build your circle</label>
				<div class="input">
					<ul class="inputs-list">
						<li><label><input type="checkbox" /> <span>Select everyone</span></label></li>
						<li><label><input type="checkbox" /> <span>Tom</span></label></li>
						<li><label><input type="checkbox" /> <span>Dick</span></label></li>
						<li><label><input type="checkbox" /> <span>Harry</span></label></li>
					</ul>
					<span class="help-block">
						Ass soon as you've confirmed your new list,
						we'll email these guys to invite them to see it
					</span>
				</div>
				<div class="input">
					<input type="submit" value="Add a friend" class="btn" onclick="alert('You have no friends');return false" />
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
				<input type="submit" value="Create my list" class="btn primary" /> or
				<a href="/">cancel</a>
			</div>
		</fieldset>
	</form>
</div>
<div class="span4">
	<h3>FAQs</h3>
	<p>Lorem...</p>
</div>





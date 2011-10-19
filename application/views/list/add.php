
<div class="span12">

	<form method="post">
		<fieldset>
			<legend>Create a list</legend>
			<div class="clearfix">
				<label>Name your gift list</label>
				<div class="input"><input name="name" placeholder="eg '30th Birthday'"></div>
			</div>

			<div class="clearfix">
				<label>Expiry date</label>
				<div class="input">
					<input name="expiry" placeholder="eg '25/12/2012'">
					<span class="help-inline">Optional</span>
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
				<input type="submit" value="Create your list" class="btn primary" /> or
				<a href="/list/my">go back to list overview</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>





<div class="span12">

	<form method="post">
		<fieldset>

			<div class="clearfix">
				<label>Name your gift list</label>
				<div class="input"><input name="name" placeholder="eg '30th Birthday'" value="<?php echo HTML::chars($list->name); ?>" /></div>
			</div>

			<div class="clearfix">
				<label>Expiry date</label>
				<div class="input">
					<input name="expiry" placeholder="eg '25/12/2012'" value="<?php echo HTML::chars($list->expiry); ?>">
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
				<input type="submit" value="Update my list" class="btn primary" /> or
				<a href="/list/mine/<?php echo $list->id; ?>">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>





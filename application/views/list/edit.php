
<div class="span12">

<h3><?php echo HTML::chars($list->name); ?></h3>

	<form method="post">

		<fieldset>
	<div class="pull-right">
		<a class="danger" href="/list/delete/<?php echo $list->id; ?>">Delete this list</a>
	</div>

			<div class="clearfix">
				<label>List name</label>
				<div class="input"><input name="name" placeholder="eg '30th Birthday'" value="<?php echo HTML::chars($list->name); ?>" /></div>
			</div>

			<div class="clearfix">
				<label>Expiry date</label>
				<div class="input">
					<input type="date" pattern="^\d{1,2}/\d{1,2}/\d{4}$" name="expiry" placeholder="eg '25/12/2012'" value="<?php echo HTML::chars($list->expiry); ?>">
					<span class="help-inline">Optional (dd/mm/yyyy)</span>
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
				<input type="submit" value="Update your list" class="btn primary" /> or
				<a href="/list/mine/<?php echo $list->id; ?>">go back to list</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>





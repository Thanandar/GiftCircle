
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


			<?php if (count($friends)) { ?>
			<fieldset>
				<legend>Add existing friends to your list</legend>

				<p>You can add more friends once your list is set up.</p>

				<div class="clearfix">
					<label>Add existing friends</label>
					<div class="input">
						<ul class="inputs-list">
							<li><label><input type="checkbox" onclick="toggle_friends(this)" /> <span>Select everyone</span></label></li>
							
							<?php foreach ($friends as $friend) { ?>
								<li>
									<label>
										<input type="checkbox" name="id[]" value="<?php echo $friend->id; ?>" /> 
										<span>
											<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname ); ?>
										</span>
									</label>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</fieldset>
			<?php } ?>

			<fieldset>
				<legend>Add new friends to your list</legend>
				<ol>
					<?php for ($i = 0; $i < 3; $i++) { ?>
					<li>
						<input type="text" name="firstname[]" placeholder="First name" />
						<input type="text" name="surname[]" placeholder="Surname" />
						<input type="text" name="email[]" placeholder="Email address" />
						<br />
						<br />
					</li>
					<?php } ?>
					<li style="list-style-type:none"><a href="#" onclick="return more_friends(this)">Add more</a></li>
				</ol>

			</fieldset>

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
	<?php echo View::factory('sidebar/faqs'); ?>
</div>



<script>
function toggle_friends(el) {
	$(el).parent().parent().parent()
		.find('input').not(el)
		.attr('checked', !!$(el).attr('checked'));
}

function more_friends(el) {
	$(el).parent().before('<li>' + $(el).parent().parent().children().first().html() + '</li>');
	return false;
}

</script>





<div class="span12">

	<h2>For circle: <?php echo HTML::chars($list->name); ?></h2>

	<form method="post">
		<?php if (count($friends)) { ?>
		<fieldset>
			<legend>Add existing friends</legend>

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
			<legend>Add new friends</legend>
			<ol>
				<?php for ($i = 0; $i < 5; $i++) { ?>
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


			<?php
			if (!empty($errors)) {
				echo '<div class="alert-message error">';
				foreach ($errors as $error) {
					echo '<p>' . $error . '</p>';
				}
				echo '</div>';
			}
			?>

			<div class="actions">
				<input name="submit" type="submit" value="Add friends" class="btn primary large" /> 
				or
				<a href="/list/mine/<?php echo $list->id; ?>">go back to list</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">

	<h2>Friends currently in this circle</h2>

	<div class="well">

		<?php if (count($circle)) { ?>
		<ul class="unstyled">
			<?php foreach ($circle as $friend) { ?>
			<li><?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?></li>
			<?php } ?>
		</ul>
		<?php } else { ?>
		<p>You have no friends in this circle</p>
		<?php } ?>

	</div>

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


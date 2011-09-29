
<div class="span12">

	<form method="post">
		<?php if (count($friends)) { ?>
		<fieldset>
			<legend>Add existing friends to "<?php echo HTML::chars($list->name); ?>"</legend>

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
					<span class="help-block">
						As soon as you've confirmed your new list,
						we'll email these guys to invite them to see it
					</span>
				</div>
			</div>
		</fieldset>
		<?php } ?>

		<fieldset>
			<legend>Add new friends to "<?php echo HTML::chars($list->name); ?>"</legend>
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
				<input name="submit" type="submit" value="Add friends" class="btn primary large" /> or
				<a href="/list/mine/<?php echo $list->id; ?>">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">

	<h2>Friends in this circle</h2>

	<div class="well">

		<?php if (count($circle)) { ?>
		<table>
			<?php foreach ($circle as $friend) { ?>
			<tr><td><?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?></td><td>✘</td></tr>
			<tr><td>Dick</td><td>✘</td></tr>
			<tr><td>Harry</td><td>✘</td></tr>
			<?php } ?>
		</table>
		<?php } else { ?>
		<p>You have no friends in this circle</p>
		<?php } ?>

		<input type="button" class="btn primary" value="Add a friend" onclick="location.href='/list/add_friend/<?php echo $list->id; ?>'"/>

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


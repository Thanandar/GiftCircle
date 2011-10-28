
<?php if ($doing_wizard) { ?>

<div class="span12">
<h2>Step 2</h2>
<p>
All the people you've added to your circle will be notified via email and once they've accepted your invite to join they'll become an active member of your circle. They'll be encouraged to create their own list so that you can see what they'd like (for Christmas, Birthday, etc). 

	</p>
</div>

<?php } ?>

<div class="span12">

	<form method="post">
		<?php if (count($friends)) { ?>
		<fieldset>
			<h2>Add existing friends</h2>

			<?php
			if (!empty($errors['existing'])) {
				echo '<div class="alert-message error">';
					echo '<p>' . $errors['existing'] . '</p>';
				echo '</div>';
			}
			?>

			<div class="clearfix">
				<div>
					<ul class="inputs-list existing-friends">
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
			<h2>Add new friends</h2>
			<ol class="new-friends">
				<?php 
				$rows = max(array(5, count(@$new_friends)));
				for ($i = 0; $i < $rows; $i++) { 
				?>
				<li>

					<input class="span3<?php if (isset($new_friends[$i][0]) && empty($new_friends[$i][0])) echo ' error'; ?>" type="text" name="firstname[]" placeholder="First name" value="<?php echo HTML::chars(@$new_friends[$i][0]) ?>" />

					<input class="span3" type="text" name="surname[]" placeholder="Surname" value="<?php echo HTML::chars(@$new_friends[$i][1]) ?>" />

					<input class="span6<?php if (isset($new_friends[$i][2]) && !filter_var($new_friends[$i][2], FILTER_VALIDATE_EMAIL)) echo ' error'; ?>" type="text" name="email[]" placeholder="Email address" value="<?php echo HTML::chars(@$new_friends[$i][2]) ?>" />

				</li>
				<?php } ?>
				<li style="list-style-type:none"><a href="#" onclick="return more_friends(this)">Add more</a></li>
			</ol>


			<?php
			if (!empty($errors['new'])) {
				echo '<div class="alert-message error">';
					echo '<p>' . $errors['new'] . '</p>';
				echo '</div>';
			}
			?>

			<?php
			if (!empty($errors['all'])) {
				echo '<div class="alert-message error">';
					echo '<p>' . $errors['all'] . '</p>';
				echo '</div>';
			}
			?>

			<div class="well">
				<input name="submit" type="submit" value="Add friends" class="btn primary" /> 
				or
				<?php if ($doing_wizard) { ?>
				<input type="hidden" name="wizard" value="true" />
				<a href="/gift/bookmarklet/<?php echo $list->id; ?>">skip this step</a>
				<?php } else { ?>
				<a href="/list/mine/<?php echo $list->id; ?>">cancel</a>
				<?php } ?>
			</div>
		</fieldset>
	</form>
</div>


<?php if (count($circle)) { ?>

<div class="span4">

	<h2>Friends already in this circle</h2>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Friend name</th>
				<th></th>
			</tr>
		</thead>
		<?php foreach ($circle as $friend) { ?>
		<tr>
			<td>
				<?php if ($friend->is_confirmed()) { ?>
				<?php echo HTML::anchor('friend/view/' . $friend->id, HTML::chars($friend->firstname . ' ' . $friend->surname)) ?>
				<?php } else { ?>
				<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?>
				<?php } ?>
			</td>
			<td width="18">
				<a class="delete" href="/list/delete_friend/<?php echo $list->id; ?>-<?php echo $friend->id; ?>">✘</a>
			</td>
		</tr>
		<?php } ?>
	</table>

</div>

<?php } ?>


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


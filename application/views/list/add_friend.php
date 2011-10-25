
<div class="span12">
<h2>Step 2</h2>
<p>
All the people you've added to your circle will be notified via email and once they've accepted your invite to join they'll become an active member of your circle. They'll be encouraged to create their own list so that you can see what they'd like (for Christmas, Birthday, etc). 

	</p>
</div>
<div class="span12">

	<form method="post">
		<?php if (count($friends)) { ?>
		<fieldset>
			<h2>Add existing friends</h2>

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
				<?php for ($i = 0; $i < 5; $i++) { ?>
				<li>
					<input class="span3" type="text" name="firstname[]" placeholder="First name" />
					<input class="span3" type="text" name="surname[]" placeholder="Surname" />
					<input class="span6" type="text" name="email[]" placeholder="Email address" />
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

			<div class="well">
				<input name="submit" type="submit" value="Add friends" class="btn primary" /> 
				or
				<a href="/list/mine/<?php echo $list->id; ?>">skip this step</a>
			</div>
		</fieldset>
	</form>
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


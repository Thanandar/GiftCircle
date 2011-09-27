
<div class="span12">

	<h2>Edit friend (ID <?php echo $friend_id; ?>)</h2>



	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label>First name: </label>
				<div class="input"><input name="firstname"></div>
			</div>
			<div class="clearfix">
				<label>Surname: </label>
				<div class="input"><input name="surname"></div>
			</div>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Email: </label>
				<div class="input">
					<input name="email" />
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Birthday: </label>
				<div class="input"><input name="birthday"></div>
			</div>			
			<div class="clearfix">
				<label>Address: </label>
				<div class="input"><textarea name="url"></textarea></div>
			</div>			


			<div class="actions">
				<input type="submit" value="Update details" class="btn primary" /> or
				<a href="/friend/list">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<h3>On your shopping list</h3>
	<ul>
		<li>COD MW3</li>
		<li>Barbie</li>
		<li>Starwars lego</li>
		<li>The Rock DVD</li>
	</ul>
</div>





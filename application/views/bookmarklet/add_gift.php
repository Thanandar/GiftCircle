
<div class="span11">

	<h3>Add gift details</h3>

	<p>The more information you provide, the better your list will be.</p>

	<form method="post">
		<fieldset>

			<div class="clearfix">
				<label>Choose a list: </label>
				<div class="input">
					<?php
					echo Form::select('list_id', $lists);
					?>
				</div>	
			</div>

			<div class="clearfix<?php if (!empty($errors['name'])) {echo ' error';} ?>">
				<label>Title: </label>
				<div class="input">
					<input name="name" autofocus="autofocus">
					<?php if (!empty($errors['name'])) {
						echo '<span class="help-inline">' . $errors['name'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix<?php if (!empty($errors['cat'])) {echo ' error';} ?>">
				<label>Category: </label>
				<div class="input">
					<?php
					Arr::unshift($categories, '', 'Please select&hellip;');
					echo Form::select('category_id', $categories);
					?>
					<?php if (!empty($errors['cat'])) {
						echo '<span class="help-inline">' . $errors['cat'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>&pound;Guide: </label>
				<div class="input">
					<div class="input-prepend">
						<span class="add-on">&pound;</span>
						<input name="price">
						<span class="help-inline">Optional</span>					
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label>Link: </label>
				<div class="input">
					<input placeholder="http://" name="url" value="<?php echo HTML::chars($url); ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Description: </label>
				<div class="input">
					<textarea class="xlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>	

			<div class="actions">
				<input type="submit" value="Add gift" class="btn primary" />
			</div>
		</fieldset>
	</form>


</div>




<div class="span11">

	<h2>Add gift details</h2>

	<p>Add at least the title but the more information you can provide, the better your list will be.</p>

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

			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Title: </label>
				<div class="input">
					<input name="name" autofocus="autofocus">
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>&pound;&nbsp;Guide: </label>
				<div class="input">
					<div class="input-prepend">
						<span class="add-on">&pound;</span>
						<input name="price">
						<span class="help-inline">Optional</span>					
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label>Category: </label>
				<div class="input">
					<?php
					Arr::unshift($categories, '', 'Please select&hellip;');
					echo Form::select('category_id', $categories);
					?>
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Link: </label>
				<div class="input">
					<input name="url" value="<?php echo HTML::chars($url); ?>">
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



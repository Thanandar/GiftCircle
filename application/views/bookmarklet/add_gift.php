
<div class="span11">

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
				<label>Product Title: </label>
				<div class="input">
					<input name="name" autofocus="autofocus">
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Price: </label>
				<div class="input">
					<div class="input-prepend">
						<span class="add-on">&pound;</span>
						<input name="price">
						<span class="help-inline">Optional</span>					
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Category: </label>
				<div class="input">
					<?php
					Arr::unshift($categories, '', '&mdash; SELECT &mdash;');
					echo Form::select('category_id', $categories);
					?>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Link: </label>
				<div class="input">
					<input name="url" value="<?php echo HTML::chars($url); ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Description: </label>
				<div class="input">
					<textarea class="xxlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>	

			<div class="actions">
				<input type="submit" value="Add item" class="btn primary" />
			</div>
		</fieldset>
	</form>


</div>



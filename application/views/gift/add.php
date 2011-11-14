
<div class="span12">

	<h3>Gift details</h3>


	<form method="post">
		<fieldset>
			<legend></legend>
			<div class="clearfix<?php if (!empty($errors['name'])) {echo ' error';} ?>">
				<label>Title: </label>
				<div class="input">
					<input name="name" value="<?php echo HTML::chars(@$_POST['name']) ?>">
					<?php if (!empty($errors['name'])) {
						echo '<span class="help-inline">' . $errors['name'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>&pound;Guide: </label>
				<div class="input">
					<div class="input-prepend">
						<span class="add-on">&pound;</span>
						<input name="price" value="<?php echo HTML::chars(@$_POST['price']) ?>">
						<span class="help-inline">Optional</span>					
					</div>
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
				<label>Link: </label>
				<div class="input">
					<input name="url" value="<?php echo HTML::chars(@$_POST['url']) ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Description: </label>
				<div class="input">
					<textarea class="xxlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."><?php echo HTML::chars(@$_POST['details']) ?></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>	

			<div class="actions">
				<input type="submit" value="Add gift" class="btn primary" /> or
				<a href="/list/mine/<?php echo $list->id; ?>">cancel</a>
			</div>
		</fieldset>
	</form>


</div>

<div class="span4">

	<h3>Get the Browser Button</h3>

	<p>
		<a href="/gift/bookmarklet/<?php echo $list->id; ?>">Get the browser button</a>
		to make adding gifts even easier.
	</p>

	<?php if (count($other_gifts)) { ?>
	<h3>On your list</h3>
	<ul>
		<?php foreach ($other_gifts as $gift) { ?>
		<li><?php echo HTML::chars($gift->name) ?></li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>





<div class="span12">

	<h2>Add item to your list "<?php echo HTML::chars($list->name); ?>"</h2>


	<form method="post">
		<fieldset>
			<legend>Product details</legend>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Product Title: </label>
				<div class="input">
					<input name="name">
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
					<input name="url">
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
				<input type="submit" value="Add item" class="btn primary" /> or
				<a href="/list/mine/<?php echo $list->id; ?>">cancel</a>
			</div>
		</fieldset>
	</form>


	<?php 
	echo View::factory('gift/browse')
		->set('categories', $categories)
		->set('departments', $departments)
		->set('shops', $shops)
		->set('list', $list);
	?>



</div>

<div class="span4">

	<h3>Get the Browser Button</h3>

	<p>
		<a href="/gift/bookmarklet">Get the browser button</a>
		to make adding gifts even easier.
	</p>


	<h3>On your list</h3>
	<ul>
		<?php foreach ($other_gifts as $gift) { ?>
		<li><?php echo HTML::chars($gift->name) ?></li>
		<?php } ?>
	</ul>
</div>




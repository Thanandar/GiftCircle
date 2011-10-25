
<div class="span12">

	<h2>Step 3</h2>
	
	<p>
		Browse for gifts and add them to your list. You can use the browser button to make this simpler.
	</p>

	<h3>Gift details</h3>


	<form method="post">
		<fieldset>
			<legend></legend>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Title: </label>
				<div class="input">
					<input name="name">
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Price: </label>
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
				</div>
			</div>
			<div class="clearfix">
				<label>Link: </label>
				<div class="input">
					<input name="url">
					<span class="help-inline">Optional</span>
				</div>
			</div>
			<div class="clearfix">
				<label>Description: </label>
				<div class="input">
					<textarea class="xxlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>	

			<div class="actions">
				<input type="submit" value="Add gift" class="btn primary" /> or
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

	<?php if (count($other_gifts)) { ?>
	<h3>On your list</h3>
	<ul>
		<?php foreach ($other_gifts as $gift) { ?>
		<li><?php echo HTML::chars($gift->name) ?></li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>





<div class="span12">

	<h2>Add item to your list "<?php echo HTML::chars($list->name); ?>"</h2>

	<div class="well">
		<input type="button" value="Browse for your item" class="btn primary" onclick="location.href='/gift/browse'" />
	</div>

	<h2>&mdash; or &mdash;</h2>

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
					<select name="category_id">
						<option value="">Please select...</option>
						<option value="1">Games</option>
						<option value="2">Toys</option>
						<option value="3">Other</option>
					</select>
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
</div>

<div class="span4">
	<h3>On your list</h3>
	<ul>
		<li>COD MW3</li>
		<li>Barbie</li>
		<li>Starwars lego</li>
		<li>The Rock DVD</li>
	</ul>
</div>





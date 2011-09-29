
<div class="span12">

	<h2>Edit gift "<?php echo HTML::chars($gift->name); ?>"</h2>


	<form method="post">
		<fieldset>
			<legend>Product details</legend>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Product Title: </label>
				<div class="input">
					<input name="name" value="<?php echo HTML::chars($gift->name); ?>">
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
						<input name="price" value="<?php echo HTML::chars($gift->price); ?>">
						<span class="help-inline">Optional</span>					
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Category: </label>
				<div class="input">
					<select>
						<option value="">Please select...</option>
						<option selected="selected">Games</option>
						<option>Toys</option>
					</select>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Link: </label>
				<div class="input">
					<input name="url" value="<?php echo HTML::chars($gift->url) ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>			
			<div class="clearfix">
				<label>Product Description: </label>
				<div class="input">
					<textarea class="xxlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."><?php echo HTML::chars($gift->details) ?></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>			


			<div class="actions">
				<input type="submit" value="Update item" class="btn primary" /> or
				<a href="/list/mine/1">cancel</a>
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





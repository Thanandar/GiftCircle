
<div class="span12">

	<h2>Add item to 30th Birthday</h2>

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
					<input name="title">
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Price: </label>
				<div class="input"><input name="price"></div>
			</div>
			<div class="clearfix">
				<label>Product Category: </label>
				<div class="input">
					<select>
						<option value="">Please select...</option>
						<option value="">Games</option>
						<option value="">Toys</option>
					</select>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Link: </label>
				<div class="input"><input name="url"></div>
			</div>			


			<div class="actions">
				<input type="submit" value="Add item" class="btn primary" /> or
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





<?php echo View::factory('page/header'); ?>

<div class="span12">

	<h2>Edit item on 30th Birthday (ID <?php echo $gift_id; ?>)</h2>



	<form method="post">
		<fieldset>
			<legend>Product details</legend>
			<div class="clearfix<?php if (!empty($errors)) {echo ' error';} ?>">
				<label>Product Title: </label>
				<div class="input">
					<input name="title" value="COD MW3">
					<?php if (!empty($errors)) {
						echo '<span class="help-inline">' . $errors . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>Product Price: </label>
				<div class="input"><input name="price" value="&pound;50"></div>
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
				<div class="input"><input name="url" value="http://amazon.co.uk/"></div>
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




<?php echo View::factory('page/footer'); ?>

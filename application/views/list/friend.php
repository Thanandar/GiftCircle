
<div class="span10">

	<h2>Bob: Xmas (ID: <?php echo $list_id; ?>)</h2>

	<form action="" method="post">

		<table class="zebra-striped">
			<thead>
				<tr>
					<th></th>
					<th>Product name</th>
					<th>Approximate Price</th>
					<th>Category</th>
					<th>Who's buying?</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name="reserve[]" value="1" /></td>
					<td>Shoes</a></td>
					<td>&pound;50</td>
					<td>Clothes</td>
					<td>Up for grabs</td>
				</tr>
				<tr>
					<td></td>
					<td>Barbie</a></td>
					<td>&pound;10</td>
					<td>Toys</td>
					<td>Harry</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="reserve[]" value="2"  /></td>
					<td>Barbie</a></td>
					<td>&pound;10</td>
					<td>Toys</td>
					<td>Up for grabs</td>
				</tr>
			</tbody>
		</table>


		<?php
		if (!empty($errors)) {
			echo '<div class="alert-message error"><p>';
			echo $errors;
			echo '</p></div>';
		}
		?>

		<div class="well">
			<input name="confirm" type="submit" class="btn primary" value="Confirm your selection" />
			or
			<a href="/">cancel</a>
		</div>
	
	</form>

</div>

<div class="span6">

	<h2>Friends in this circle</h2>

	<div class="well">

		<table>
			<tr><td>Tom</td></tr>
			<tr><td>Dick</td></tr>
			<tr><td>Harry</td></tr>
		</table>

	</div>

</div>


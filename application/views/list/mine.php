<?php echo View::factory('page/header'); ?>

<div class="span10">

<h2>Current list: 30th Birthday (ID: <?php echo $list_id; ?>)</h2>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Product name</th>
				<th>Approximate Price</th>
				<th>Category</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>COD MW3</td>
				<td>&pound;50.99</td>
				<td>Games</td>
				<td>✘</td>
			</tr>
			<tr>
				<td>barbie</td>
				<td>&pound;35.99</td>
				<td>Toys</td>
				<td>✘</td>
			</tr>
		</tbody>
	</table>

	<div class="well">
		<input type="button" class="btn primary" value="Add gifts to this list" onclick="location.href='/gift/add'"/>
	</div>


</div>

<div class="span6">

	<h2>Friends in this circle</h2>

	<div class="well">

		<table>
			<tr><td>Tom</td><td>✘</td></tr>
			<tr><td>Dick</td><td>✘</td></tr>
			<tr><td>Harry</td><td>✘</td></tr>
		</table>

		<input type="button" class="btn primary" value="Add a friend" onclick="location.href='/list/add_friend'"/>

	</div>

</div>

<?php echo View::factory('page/footer'); ?>

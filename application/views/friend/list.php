<?php echo View::factory('page/header'); ?>

<div class="span12">


	<h2>My friends</h2>



	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Friend</th>
				<th>Email</th>
				<th>Birthday</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><a href="/friend/edit/1">Tom</a></td>
				<td>tom@example.com</td>
				<td>01/01/1999</td>
				<td>✘</td>
			</tr>
			<tr>
				<td><a href="/friend/edit/2">Dick</a></td>
				<td>dick@example.com</td>
				<td>02/01/1999</td>
				<td>✘</td>
			</tr>
			<tr>
				<td><a href="/friend/edit/3">Harry</a></td>
				<td>harry@example.com</td>
				<td>03/01/1999</td>
				<td>✘</td>
			</tr>
		</tbody>
	</table>

	<div class="well">
		<input type="button" class="btn primary" value="Add a friend" onclick="location.href='/friend/add'"/>
	</div>



</div>

<div class="span4">

	<h2>On my shopping list</h2>

	<ul>
		<li><a href="/gift/buy/1">Barbie</a></li>
		<li><a href="/gift/buy/2">Made in Chelsea DVD</a></li>
	</ul>

</div>

<?php echo View::factory('page/footer'); ?>

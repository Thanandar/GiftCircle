
<div class="span12">


	<h2>My friends</h2>

<pre>
THIS IS NOT IMPLEMENTED.

We're not adding birthdays.

Would be nice to have:
- see which of your own lists your friends are on (and remove them)
- see what lists yor friends have
- update a friend
- way to tell if a friend is registered
- message about friends having to register with the same email
</pre>

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
				<td>there's nowhere to add birthdays when adding friends</td>
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


</div>

<div class="span4">

	<h2>On my shopping list</h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
	
</div>


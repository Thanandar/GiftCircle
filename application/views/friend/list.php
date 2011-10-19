
<div class="span12">


	<?php if (count($friends)) { ?>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Friend</th>
				<th>Email</th>
				<!-- <th>Birthday</th> -->
			</tr>
		</thead>
		<tbody>
			<?php foreach ($friends as $friend) { ?>
			<tr>
				<td>
					<a href="/friend/view/<?php echo $friend->id; ?>">
						<?php echo HTML::chars($friend->firstname) ?>
						<?php echo HTML::chars($friend->surname) ?>
					</a>
				</td>
				<td><?php echo HTML::chars($friend->email) ?></td>
				<!-- <td>there's nowhere to add birthdays when adding friends</td> -->
			</tr>
			<?php } ?>
		</tbody>
	</table>


	<?php } else { ?>

	<p>You haven't added any friends yet. <a href="/list/add">Create a list</a> to add some friends.</p>

	<?php } ?>

</div>

<div class="span4">

	<h2>Shopping list</h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
	
</div>


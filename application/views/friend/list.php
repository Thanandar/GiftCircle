
<div class="span12">


	<h2>My friends</h2>

	<?php if (count($friends)) { ?>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Friend</th>
				<th>Email</th>
				<!-- <th>Birthday</th> -->
				<th></th>
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
				<td>
					<a href="/friend/delete/<?php echo $friend->id; ?>" onclick="return confirm('Are you sure you want to delete this friend?\n\nThis will remove them from all your lists too.')"><span class="label important">✘</span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>


	<?php } else { ?>

	<p>You haven't added any friends yet. <a href="/list/add">Create a list</a> to add some friends.</p>

	<?php } ?>

</div>

<div class="span4">

	<h2>On my shopping list</h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
	
</div>


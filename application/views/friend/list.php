
<div class="span16">
	
	<?php if (count($friends)) { ?>

	<table class="zebra-striped sort">
		<thead>
			<tr>
				<th class="{sorter: false}"></th>
				<th>Name</th>
				<th class="{parser: 'shortDate'}">Birthday</th>
				<th>Address</th>
				<th class="{sorter: false}"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($friends as $friend) { ?>
			<tr>
				<td>
					<?php if ($friend->is_confirmed()) { ?>
					C
					<?php } ?>
				</td>
				<td>
					<a href="/friend/edit/<?php echo $friend->id; ?>">
						<?php echo HTML::chars($friend->firstname) ?>
						<?php echo HTML::chars($friend->surname) ?>
					</a>
					<br />
					<?php echo HTML::chars($friend->email) ?>
				</td>
				<td><?php echo HTML::chars($friend->birthday) ?></td>
				<td><?php echo nl2br(HTML::chars($friend->address)) ?></td>
				<td>
					<?php if ($friend->is_confirmed()) { ?>
					<a class="btn" href="/friend/view/<?php echo $friend->id; ?>">10 circles</a>
					<?php } else {  ?>
					<input class="btn" type="button" disabled="disabled" value="0 circles" />
					<?php }  ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>


	<?php } else { ?>

	<p>You haven't added any friends yet. . <a href="/list/add">Create a circle</a> to add some friends to.</p>

	<?php } ?>

</div>

<div class="span4">

	<h2>Shopping list</h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
	
</div>


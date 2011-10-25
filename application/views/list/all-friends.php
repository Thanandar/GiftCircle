<?php if (count($lists)) { ?>


<table class="zebra-striped">
	<thead>
		<tr>
			<th>Circle name</th>
			<th>Who's circle?</th>
			<th>Total items</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lists as $list) { ?>
		<tr>
			<td>
				<a href="/list/friend/<?php echo $list->id; ?>">
					<?php echo HTML::chars($list->name); ?>
				</a>
			</td>
			<td><?php echo HTML::chars($list->owner->firstname . ' ' . $list->owner->surname); ?></td>
			<td><?php echo HTML::chars($list->total_gifts()); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<div class="well">
	<a class="btn" href="/friend/list">All friends' circles</a>
</div>

<?php } ?>

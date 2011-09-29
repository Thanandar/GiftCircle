<?php if (count($lists)) { ?>


<table class="zebra-striped">
	<thead>
		<tr>
			<th>List name</th>
			<th>Who's list?</th>
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
			<td><?php echo HTML::chars($list->total_items); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else { ?>

<p>None of your friends have added you to any lists.</p>

<?php } ?>

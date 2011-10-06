<?php

if (count($lists)) {
	

?>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>List name</th>
			<th>Total gifts</th>
			<th>Friends in my circle</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lists as $list) { ?>
		<tr>
			<td>
				<a href="/list/mine/<?php echo $list->id; ?>">
					<?php echo HTML::chars($list->name); ?>
				</a>
			</td>
			<td><?php echo HTML::chars($list->total_gifts()); ?></td>
			<td><?php echo HTML::chars($list->total_friends()); ?></td>
			<td><a href="/list/delete/<?php echo $list->id; ?>" onclick="return confirm('Are you sure you want to delete this list?\n\nThis will remove all gifts on this list too.')"><span class="label important">✘</span></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }  else { ?>

<p>You have no lists</p>

<?php }
?>



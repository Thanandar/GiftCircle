<?php

if (count($lists)) {
	

?>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Circle name</th>
			<th>Total gifts</th>
			<th>Friends in your circle</th>
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
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }  else { ?>

<p>You have no circles</p>

<?php }
?>



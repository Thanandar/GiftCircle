<?php

if (count($lists)) {
	

?>

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>List name</th>
			<th width="150">Total gifts</th>
			<th width="150">Friends in your circle</th>
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

<p>Right now, you haven't created any circles. Get started by clicking the button below.</p>

<?php }
?>



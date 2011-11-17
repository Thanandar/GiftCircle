<?php

if (count($lists)) {
	

?>

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>List name</th>
			<th width="150">Friends in your circle</th>
			<th width="100">Total gifts</th>
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
			<td style="text-align:right"><?php echo HTML::chars($list->total_friends()); ?></td>
			<td style="text-align:right"><?php echo HTML::chars($list->total_gifts()); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }  else { ?>

<p>Right now, you haven't created any lists. Get started by clicking the button below.</p>

<?php }
?>



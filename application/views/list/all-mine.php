<?php

if (count($lists)) {
	

?>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>List name</th>
			<th>Total items</th>
			<th>Friends in my circle</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lists as $list) { ?>
		<tr>
			<td>
				<a href="/list/mine/<?php echo $list->id; ?>">
					<?php echo Kohana_HTML::chars($list->name); ?>
				</a>
			</td>
			<td></td>
			<td></td>
			<td><a href="/list/delete/<?php echo $list->id; ?>" onclick="return confirm('Are you sure you want to delete this list?')"><span class="label important">✘</span></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }  else { ?>

<p>You have no lists</p>

<?php }
?>



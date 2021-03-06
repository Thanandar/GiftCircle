
<?php if (count($gifts)) { 

$total = 0;
$count = 0;
?>

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>Gift&nbsp;name</th>
			<th width="60">&pound;Guide</th>
			<th>Who&nbsp;for?</th>
			<th>List</th>
			<th>Category</th>
			<th width="120" class="{sorter: false}"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($gifts as $gift) { ?>
		<?php 
		$count++;
		if (empty($show_total) && $count > 5) {
			break;
		}
		$total += $gift->price;
		$list = new Model_List($gift->list_id);
		$owner = new Model_Owner($list->owner_id);
		$bought = !empty($gift->buyer_id);
		?>

		<tr>
			<td>
				<?php if ($bought) { ?>
				<?php echo HTML::chars($gift->name) ?>
				<?php } else { ?>
				<a href="/gift/buy/<?php echo $gift->id; ?>"><?php echo HTML::chars($gift->name) ?></a>
				<?php } ?>
			</td>
			<td style="text-align:right"><?php echo ($gift->price()) ?></td>
			<td><?php echo HTML::chars($owner->firstname . ' ' . $owner->surname) ?></td>
			<td><?php echo HTML::chars($list->name) ?></td>
			<td><?php echo HTML::chars($gift->category->name) ?></td>
			<td class="mark-as-bought">
				<?php if (!$bought) { ?>
					<a class="btn" title="Mark as bought" href="/gift/mark_as_bought/<?php echo $gift->id; ?>">Mark as bought</a>
					<br />or
					<a href="/gift/unreserve/<?php echo $gift->id; ?>">remove from list</a>
				<?php } else { ?>
				unbuy?
				<?php } ?>
			</td>
		</tr>
		<?php } ?>

	</tbody>
	<?php if (!empty($show_total)) { ?>
	<tfoot>
	<tr>
		<td><strong>Total</strong></td>
		<td style="text-align:right"><strong>&pound;<?php echo number_format($total, 2); ?></strong></td>
		<td colspan="4">&nbsp;</td>
	</tr>
	</tfoot>
	<?php } ?>
</table>

<?php } else { ?>
	


<?php }?>

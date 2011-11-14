
<?php if (count($gifts)) { 

$total = 0;

?>

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>Gift&nbsp;name</th>
			<th>&pound;&nbsp;Guide</th>
			<th>Who&nbsp;for?</th>
			<th>List</th>
			<th>Category</th>
			<th width="120" class="{sorter: false}"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($gifts as $gift) { ?>
		<?php 
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
			<td><?php echo HTML::chars($gift->name) ?></td>
			<td>
				<?php if (!$bought) { ?>
					<a class="btn" title="Mark as bought" href="/gift/mark_as_bought/<?php echo $gift->id; ?>">Mark as bought</a>
					<br />or
					<a href="/gift/unreserve/<?php echo $gift->id; ?>">remove from list</a>
				<?php } else { ?>
				unbuy?
				<?php } ?>
			</td>
		</tr>
		<?php } 

		if (!empty($show_total)) { ?>
		<tr>
			<th>Total</th>
			<th style="text-align:right">&pound;<?php echo number_format($total, 2); ?></th>
			<th colspan="4">&nbsp;</th>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else { ?>
	


<?php }?>

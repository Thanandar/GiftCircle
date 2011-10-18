
<?php if (count($gifts)) { ?>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Product name</th>
			<th>Approx price</th>
			<th>Who for?</th>
			<th>List name</th>
			<th width="235"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($gifts as $gift) { ?>
		<?php 
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
			<td>&pound;<?php echo HTML::chars($gift->price) ?></td>
			<td><?php echo HTML::chars($owner->firstname . ' ' . $owner->surname) ?></td>
			<td><?php echo HTML::chars($list->name) ?></td>
			<td>
				<?php if (!$bought) { ?>
					<a class="btn" title="Mark as bought" href="/gift/mark_as_bought/<?php echo $gift->id; ?>">Mark as bought</a>
					or
					<a href="/gift/unreserve/<?php echo $gift->id; ?>" onclick="return confirm('Are you sure you want to remove this this product from your list?')">remove from list</a>
				<?php } else { ?>
				unbuy?
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else { ?>
	
<p>No items on your shopping list</p>

<?php }?>

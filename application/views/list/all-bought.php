
<?php if (count($gifts)) { ?>

<h2>Bought gifts</h2>

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>Gift&nbsp;name</th>
			<th>&pound;&nbsp;Guide</th>
			<th>Who&nbsp;for?</th>
			<th>List</th>
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
			<td style="text-align:right"><?php echo ($gift->price()) ?></td>
			<td><?php echo HTML::chars($owner->firstname . ' ' . $owner->surname) ?></td>
			<td><?php echo HTML::chars($list->name) ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else { ?>
	
<?php }?>

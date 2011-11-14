
<?php if (count($gifts)) { 

$total = 0;

?>

<h2>Bought gifts</h2>

<form action="/gift/clear" method="post">

<table class="zebra-striped sort">
	<thead>
		<tr>
			<th>Gift&nbsp;name</th>
			<th>&pound;&nbsp;Guide</th>
			<th>Who&nbsp;for?</th>
			<th>List</th>
			<th>Category</th>
			<th></th>
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
			<td style="text-align:right">
				&pound;
				<input style="text-align:right" class="span2" name="price[<?php echo $gift->id; ?>]" value="<?php echo ($gift->price()) ?>" />
			</td>
			<td><?php echo HTML::chars($owner->firstname . ' ' . $owner->surname) ?></td>
			<td><?php echo HTML::chars($list->name) ?></td>
			<td><?php echo HTML::chars($gift->category->name) ?></td>
			<td><a class="delete" href="/gift/clear/<?php echo $gift->id; ?>">✘</a></td>
		</tr>
		<?php } ?>

		<?php if (!empty($show_total)) { ?>
		<tr>
			<th>Total</th>
			<th style="text-align:right">&pound;<?php echo number_format($total, 2); ?></th>
			<th colspan="4">&nbsp;</th>
		</tr>
		<?php } ?>

	</tbody>
</table>

<div class="well">
	<input class="btn" type="submit" value="Update gift prices" />
</div>

</form>

<?php } else { ?>
	
<?php }?>

<?php if (count($gifts)) { ?>

<table class="zebra-striped">
	<thead>
		<tr>
			<th width="180">Gift name</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($gifts as $gift) { ?>
		<tr>
			<td><a href="/gift/buy/<?php echo $gift->id; ?>"><?php echo $gift->name; ?></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>



<?php } else { ?>

<p>You have no gifts on your shopping list.</p>

<?php } ?>
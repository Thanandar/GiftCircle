<?php if (count($gifts)) { ?>

<table class="zebra-striped">
	<tbody>
		<?php foreach ($gifts as $gift) { ?>
		<tr>
			<td><a href="/gift/buy/<?php echo $gift->id; ?>"><?php echo $gift->name; ?></a> for <?php echo HTML::chars($gift->list->owner->firstname) ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>



<?php } else { ?>

<p>You have no gifts on your shopping list.</p>

<?php } ?>
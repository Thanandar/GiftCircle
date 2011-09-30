<?php if (count($gifts)) { ?>

<ul>
	<?php foreach ($gifts as $gift) { ?>
	<li>
		<a href="/gift/buy/<?php echo $gift->id; ?>"><?php echo HTML::chars($gift->name) ?></a>
	</li>
	<?php } ?>
</ul>

<?php } else { ?>

<p>You have no gifts on your shopping list.</p>

<?php } ?>
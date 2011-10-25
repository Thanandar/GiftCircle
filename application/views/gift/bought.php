
<div class="span12">

	<h2>You have bought '<?php echo HTML::chars($gift->name); ?>'</h2>

	<?php if ($previously_subscribed) { ?>
	<div class="alert-message info">
		<p>
			You have been automatically unsubscribed from the list "<?php echo HTML::chars($gift->list->name) ?>".

			<input class="btn" type="button" value="Subscribe" onclick="location.href='/list/subscribe/<?php echo $gift->list->id; ?>'" />
		</p>
	</div>
	<?php } ?>

	<div class="well">
		<input type="button" class="btn" value="Back to your lists" onclick="location.href='/'" />
	</div>


</div>

<div class="span4">
	<h3>On your shopping list</h3>
	<?php if (count($shopping_list)) { ?>
	<ul>
		<?php foreach ($shopping_list as $item) { ?>
		<li><a href="/gift/buy/<?php echo $item->id; ?>"><?php echo HTML::chars($item->name); ?></a></li>
		<?php } ?>
	</ul>
	<?php } else { ?>

	<p>There are no gifts on your shopping list</p>

	<?php } ?>
</div>





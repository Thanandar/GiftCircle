
<div class="span12">

	<h2>You have bought '<?php echo HTML::chars($gift->name); ?>'</h2>

	<div class="well">
		<input type="button" class="btn" value="Back to my lists" onclick="location.href='/'" />
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

	<p>There are no items on your shopping list</p>

	<?php } ?>
</div>





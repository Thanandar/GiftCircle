
<div class="span12">

	<h2>Shop for '<?php echo HTML::chars($gift->name); ?>' now</h2>
	
	<h3>
		For <?php echo HTML::chars($gift->list->owner->firstname . ' ' . $gift->list->owner->surname); ?>'s list "<?php echo HTML::chars($gift->list->name); ?>"
	</h3>
	
	<dl>
		<dt>Approximate price</dt>
			<dd>&pound;<?php echo HTML::chars($gift->price); ?></dd>
		<dt>Category</dt>
			<dd><?php echo HTML::chars($gift->category->name); ?></dd>
		<dt>Description</dt>
			<dd><?php echo HTML::chars($gift->details); ?></dd>
	</dl>

	<p>Click a retailer logo to browse. Mark the gift as bought after you've bought it.</p>

	<div class="well">

		<?php if ($gift->url) { ?>
		<input type="button" class="btn primary" value="Buy from preset URL" onclick="window.open('<?php echo HTML::chars($gift->url); ?>')" />
		
		<?php } ?>

		<input type="button" class="btn" value="Mark as bought" onclick="location.href='/gift/bought/<?php echo $gift->id; ?>'" />
	</div>

	<hr />

	<h3>Category &gt; <?php echo HTML::chars($gift->category->name); ?></h3>

	<ul class="media-grid">
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
		<li>
			<a href="http://tesco.com" target="_blank">
				<img src="http://placehold.it/150x100&amp;text=Tesco" alt="Tesco" />
			</a>
		</li>
	</ul>

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





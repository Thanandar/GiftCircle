
<div class="span12">

	<h3>
		For <?php echo HTML::chars($gift->list->owner->firstname); ?>'s list: <?php echo HTML::chars($gift->list->name); ?>
	</h3>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Gift name</th>
				<th>&pound;Guide</th>
				<th>Category</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<?php

				if ($gift->reserver_id) {
					$reserver = new Model_Owner($gift->reserver_id);
				} else {
					$reserver = new Model_Owner;
				}

				if ($gift->buyer_id) {
					$buyer = new Model_Owner($gift->reserver_id);
				} else {
					$buyer = new Model_Owner;
				}

			?>

			<tr>
				<td>
					<?php echo HTML::chars($gift->name) ?>
				</td>
				<td style="text-align:right">
					<?php echo ($gift->price()) ?>
				</td>
				<td>
					<?php echo HTML::chars($gift->category->name) ?>
				</td>
				<td>
					<?php echo HTML::chars($gift->details) ?>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="well">

		<?php if ($gift->url) { ?>
		<input type="button" class="btn primary" value="Buy from the shop <?php echo HTML::chars($gift->list->owner->firstname); ?> recommended" onclick="window.open('<?php echo HTML::chars($gift->affiliate_url()); ?>')" />
		
		<?php } ?>

		<input type="button" class="btn" value="Mark as bought" onclick="location.href='/gift/mark_as_bought/<?php echo $gift->id; ?>'" />
	</div>
	<hr />

	<h3>Category &gt; <?php echo HTML::chars($gift->category->name); ?></h3>

	<p>Click a retailer logo to browse. Mark the gift as bought after you've bought it.</p>

	<ul class="media-grid shop-logos">
		<?php foreach ($shops as $shop) { ?>
		<li>
			<a href="<?php echo HTML::chars($shop->url); ?>" target="_blank">
				<!--<img src="http://placehold.it/150x100&amp;text=<?php echo HTML::chars($shop->name); ?>" alt="<?php echo HTML::chars($shop->name); ?>" />-->
				<img src="<?php echo HTML::chars($shop->logo); ?>" alt="<?php echo HTML::chars($shop->name); ?>" title="<?php echo HTML::chars($shop->name); ?>" />
			</a>
		</li>
		<?php } ?>
	</ul>

	

</div>

<div class="span4">
	<h3>On your<br /> shopping list</h3>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
</div>



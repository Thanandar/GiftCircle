
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
					<?php if ($gift->url) { ?>
					<a target="_blank" href="<?php echo HTML::chars($gift->affiliate_url()); ?>"><?php echo HTML::chars($gift->name) ?></a>
					<?php } else { ?>
					<?php echo HTML::chars($gift->name) ?>
					<?php } ?>
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

	<?php if (!$gift->buyer_id) { ?>
	<div class="well">

		<input type="button" class="btn primary" value="Reserve gift" onclick="location.href='/gift/reserve/<?php echo $gift->id; ?>'" /> or <a href="/list/friend/<?php echo $gift->list->id; ?>">cancel</a>
	</div>
	<?php } ?>

</div>

<div class="span4">
	<h3>On your<br /> shopping list</h3>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
</div>



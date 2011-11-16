<?php 

$reservable_gifts = 0;

?>

<div class="span12">

	<h2>
		<?php echo HTML::chars($list->owner->firstname . ' ' . $list->owner->surname) ?>'s list: 
		<?php echo HTML::chars($list->name) ?></h2>

	<p>Check the boxes then click reserve</p>

	<form action="" method="post">

		<?php if (count($gifts)) { ?>
		<table class="zebra-striped">
			<thead>
				<tr>
					<th></th>
					<th>Gift name</th>
					<th>&pound;Guide</th>
					<th>Category</th>
					<th>Who's buying?</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($gifts as $gift) { ?>
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
						<?php if (!$reserver->id) { ?>
						<input type="checkbox" name="reserve[]" value="<?php echo $gift->id; ?>" />
						<?php } ?>
					</td>
					<td>
						<?php if ($reserver->id == $me->id && $buyer->id != $me->id) { ?>
						<a href="/gift/buy/<?php echo $gift->id; ?>"><?php echo HTML::chars($gift->name) ?></a>
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
						<?php 
						if ($reserver->id == $me->id) {
							if ($buyer->id == $me->id) {
								echo '<em>You\'ve bought this</em>';
							} else {
								?>
								<a class="btn" title="Mark as bought" href="/gift/mark_as_bought/<?php echo $gift->id; ?>">Mark as bought</a>
								or
								<a title="Un-reserve" href="/gift/unreserve/<?php echo $gift->id; ?>" onclick="return confirm('Are you sure you want to un-reserve this product?')">remove from list</a>
								<?php
							}
						} else {
							if ($reserver->id) {
								echo '<em>Taken</em>';
								//echo HTML::chars($reserver->firstname . ' ' . $reserver->surname);
							} else {
								$reservable_gifts++;
								echo '<em>Up for grabs</em>';
							}
						}
						?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>


		<?php
		if (!empty($errors)) {
			echo '<div class="alert-message error"><p>';
			echo $errors;
			echo '</p></div>';
		}


		if ($reservable_gifts) { ?>
			<div class="well">
				<input name="confirm" type="submit" class="btn primary" value="Reserve selected gifts" />
				or
				<a href="/friend/list">cancel</a>
			</div>
		<?php } ?>
	

	
		<?php } else { ?>

		<p>There are no gifts in this list</p>

		<div class="well">
			<a class="btn primary" href="/">Go back</a>
		</div>


		<?php } ?>

	</form>

</div>

<div class="span4">

	<h2>Friends with this list</h2>


	<?php if (count($friends)) { ?>
	<table class="zebra-striped">
		<?php foreach ($friends as $friend) { ?>
		<tr>
			<td>
				<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?>
			</td>
		</tr>
		<?php } ?>
	</table>

	<?php } else { ?>
	<p>There are no friends in this circle</p>
	<?php } ?>

	<div class="well">	
		
		<h5>Notifications</h5>

		<p>Notifications keep you informed about changes to this list.
				You can unsubscribe from these here.</p>

		<p>
			<input id="subscribe" name="subscribe" value="subscribe" type="checkbox" <?php if ($subscribed) { ?> checked="checked" <?php } ?>
			/>
			&nbsp;
		</p>
	</div>

</div>


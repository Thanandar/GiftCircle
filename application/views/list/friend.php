
<div class="span12">

	<h2>
		<?php echo HTML::chars($list->owner->firstname . ' ' . $list->owner->surname) ?>'s list: 
		<?php echo HTML::chars($list->name) ?></h2>

	<form action="" method="post">

		<?php if (count($gifts)) { ?>
		<table class="zebra-striped">
			<thead>
				<tr>
					<th></th>
					<th>Product name</th>
					<th>Approximate Price</th>
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
					<td>
						&pound;<?php echo HTML::chars($gift->price) ?>
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
								<a title="Mark as bought" href="/gift/bought/<?php echo $gift->id; ?>" onclick="return confirm('Mark this item as bought?')"><span class="label success">✔</span></a>
								<a title="Un-reserve" href="/gift/unreserve/<?php echo $gift->id; ?>" onclick="return confirm('Are you sure you want to un-reserve this product?')"><span class="label important">✘</span></a>
								<?php
							}
						} else {
							if ($reserver->id) {
								echo HTML::chars($reserver->firstname . ' ' . $reserver->surname);
							} else {
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
		?>

		<div class="well">
			<input name="confirm" type="submit" class="btn primary" value="Reserve selected gifts" />
			or
			<a href="/">cancel</a>
		</div>
	
		<?php } else { ?>

		<p>There are no gifts in this list</p>

		<div class="well">
			<a class="btn primary" href="/">Go back</a>
		</div>


		<?php } ?>

	</form>

</div>

<div class="span4">

	<h2>Friends in this circle</h2>

	<div class="well">

		<?php if (count($friends)) { ?>
		<table>
			<?php foreach ($friends as $friend) { ?>
			<tr><td><?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?></td></tr>
			<?php } ?>
		</table>
		<?php } else { ?>
		<p>There are no friends in this circle</p>
		<?php } ?>

	</div>

</div>


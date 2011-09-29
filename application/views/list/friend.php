
<div class="span10">

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
				<tr>
					<td><input type="checkbox" name="reserve[]" value="<?php echo $gift->id; ?>" /></td>
					<td><?php echo HTML::chars($gift->name) ?></td>
					<td>&pound;<?php echo HTML::chars($gift->price) ?></td>
					<td><?php echo HTML::chars($gift->category_id) ?></td>
					<td>reserved:<?php echo HTML::chars($gift->reserved) ?> bought:<?php echo HTML::chars($gift->bought) ?></td>
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
			<input name="confirm" type="submit" class="btn primary" value="Confirm your selection" />
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

<div class="span6">

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


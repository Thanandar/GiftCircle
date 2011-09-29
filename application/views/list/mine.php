
<div class="span10">

<h2>Current list: "<?php echo HTML::chars($list->name); ?>"</h2>
	
	<?php if (count($gifts)) { ?>
	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Product name</th>
				<th>Approximate Price</th>
				<th>Category</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($gifts as $gift) { ?>
			<tr>
				<td><a href="/gift/edit/<?php echo $gift->id; ?>"><?php echo $gift->name; ?></a></td>
				<td>&pound;<?php echo $gift->price; ?></td>
				<td><?php echo $gift->category_id; ?></td>
				<td>
					<span class="label important">
						<a onclick="return confirm('Are you sure you want to delete this gift?')" href="/gift/delete/<?php echo $gift->id; ?>">✘</a>
					</span>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>

	<p>This list currently has no gifts</p>

	<?php } ?>

	<div class="well">
		<input type="button" class="btn primary" value="Add a gift to this list" onclick="location.href='/gift/add/<?php echo $list->id; ?>'"/>
		<input type="button" class="btn" value="Edit this list" onclick="location.href='/list/edit/<?php echo $list->id; ?>'"/>
		<input type="button" class="btn danger" a href="" onclick="if (confirm('Are you sure you want to delete this list?')) {location.href='/list/delete/<?php echo $list->id; ?>'}" value="Delete this list" />
		or
		<a href="/list/all">back to all lists</a>
	</div>


</div>

<div class="span6">

	<h2>Friends in this circle</h2>

	<div class="well">

		<?php if (count($friends)) { ?>
		<table>
			<?php foreach ($friends as $friend) { ?>
			<tr><td><?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?></td><td>✘</td></tr>
			<?php } ?>
		</table>
		<?php } else { ?>
		<p>You have no friends in this circle</p>
		<?php } ?>

		<input type="button" class="btn primary" value="Add a friend" onclick="location.href='/list/add_friend/<?php echo $list->id; ?>'"/>

	</div>

</div>


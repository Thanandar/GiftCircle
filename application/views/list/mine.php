
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
		<input type="button" class="btn primary large" value="Add a gift to this list" onclick="location.href='/gift/add/<?php echo $list->id; ?>'"/>
		<input type="button" class="btn" value="Edit this list" onclick="location.href='/list/edit/<?php echo $list->id; ?>'"/>
		<input type="button" class="btn danger" a href="" onclick="if (confirm('Are you sure you want to delete this list?')) {location.href='/list/delete/<?php echo $list->id; ?>'}" value="Delete this list" />
	</div>


</div>

<div class="span6">

	<h2>Friends in this circle</h2>

	<div class="well">

		<table>
			<tr><td>Tom</td><td>✘</td></tr>
			<tr><td>Dick</td><td>✘</td></tr>
			<tr><td>Harry</td><td>✘</td></tr>
		</table>

		<input type="button" class="btn primary" value="Add a friend" onclick="location.href='/list/add_friend'"/>

	</div>

</div>


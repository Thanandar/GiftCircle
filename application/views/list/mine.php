
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
				<td><?php echo HTML::chars($gift->category->name); ?></td>
				<td>
					<span class="label important">
						<?php if ($gift->reserver_id) { ?>
							<a href="/gift/delete/<?php echo $gift->id; ?>">✘</a>
						<?php } else { ?>
							<a href="/gift/delete/<?php echo $gift->id; ?>">✘</a>
						<?php } ?>
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
		<input type="button" class="btn danger" a href="" onclick="location.href='/list/delete/<?php echo $list->id; ?>'" value="Delete this list" />
		or
		<a href="/list/my">back to all lists</a>
	</div>


</div>

<div class="span6">

	<h2>Friends in this circle</h2>

	<div class="well">

		<?php if (count($friends)) { ?>
		<table>
			<?php foreach ($friends as $friend) { ?>
			<tr>
				<td>
					<?php if ($friend->is_confirmed()) { ?>
					<?php echo HTML::anchor('friend/view/' . $friend->id, HTML::chars($friend->firstname . ' ' . $friend->surname)) ?>
					<?php } else { ?>
					<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?>
					<?php } ?>
				</td>
				<td width="18">
					<span class="label important">
						<a href="/list/delete_friend/<?php echo $list->id; ?>-<?php echo $friend->id; ?>">✘</a>
					</span>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } else { ?>
		<p>You have no friends in this circle</p>
		<?php } ?>

		<input type="button" class="btn primary" value="Add friends" onclick="location.href='/list/add_friend/<?php echo $list->id; ?>'"/>
		
	</div>

</div>


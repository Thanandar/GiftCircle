
<div class="span8">

<div class="pull-right">
		<a href="/list/edit/<?php echo $list->id; ?>">
			Edit circle details
		</a>
</div>

<h2><?php echo HTML::chars($list->name); ?></h2>
	
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
				<td><?php echo $gift->price ? '&pound;' . $gift->price : ''; ?></td>
				<td><?php echo HTML::chars($gift->category->name); ?></td>
				<td>
					<a class="delete" href="/gift/delete/<?php echo $gift->id; ?>">✘</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>

	<p>This list currently has no gifts</p>

	<?php } ?>

	<div class="well">
		<input type="button" class="btn primary large" value="Add gifts" onclick="location.href='/gift/add/<?php echo $list->id; ?>'"/>
		or
		<a href="/list/my">go back to circle overview</a>
	</div>


</div>

<div class="span8">

	<h2>Friends in this circle</h2>

	<div>

		<?php if (count($friends)) { ?>
		<table class="zebra-striped">
			<thead>
				<tr>
					<th>Friend name</th>
					<th></th>
				</tr>
			</thead>
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
					<a class="delete" href="/list/delete_friend/<?php echo $list->id; ?>-<?php echo $friend->id; ?>">✘</a>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } else { ?>
		<p>You have no friends in this circle</p>
		<?php } ?>

		<div class="well">
			<input type="button" class="btn primary large" value="Add friends" onclick="location.href='/list/add_friend/<?php echo $list->id; ?>'"/>
		</div>
	</div>

</div>





<div class="span16">

	<div class="pull-right" style="margin: -10px 0 10px">
			<a href="/list/edit/<?php echo $list->id; ?>">Edit circle details</a>
			|
			<a href="/list/my">Back to overview</a>
	</div>
</div>




<div class="span8">

	<h2>Gifts on this list</h2>
	
	<?php if (count($gifts)) { ?>
	<table class="zebra-striped sort">
		<thead>
			<tr>
				<th width="180">Gift name</th>
				<th width="60">&pound;Guide</th>
				<th>Category</th>
				<th class="{sorter: false}"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($gifts as $gift) { ?>
			<tr>
				<td><a href="/gift/edit/<?php echo $gift->id; ?>"><?php echo $gift->name; ?></a></td>
				<td style="text-align:right"><?php echo $gift->price ? $gift->price() : ''; ?></td>
				<td><?php echo HTML::chars($gift->category->name); ?></td>
				<td>
					<a class="delete" href="/gift/delete/<?php echo $gift->id; ?>">✘</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } else { ?>


	<?php } ?>

	<div class="well">
		<input type="button" class="btn primary" value="Add gifts" onclick="location.href='/gift/browse/<?php echo $list->id; ?>'"/>
	</div>

</div>



<div class="span8">

	<h2>Friends in this circle</h2>

	<div>

		<?php if (count($friends)) { ?>
		<table class="zebra-striped sort">
			<thead>
				<tr>
					<th width="20"></th>
					<th>Friend name</th>
					<th class="{sorter: false}"></th>
				</tr>
			</thead>
			<?php foreach ($friends as $friend) { ?>
			<tr>
				<td>
					<?php if ($friend->is_confirmed()) { ?>
						<img src="/img/confirmed.png"  alt="Confirmed"  title="Confirmed" class="confirmed" />
					<?php } else { ?>
						<img src="/img/pending.png" alt="Pending"  title="Pending" class="pending" />
					<?php } ?>
				</td>
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
		<?php } ?>

		<div class="well">
			<input type="button" class="btn primary" value="Add friends" onclick="location.href='/list/add_friend/<?php echo $list->id; ?>'"/>
		</div>
	</div>

</div>

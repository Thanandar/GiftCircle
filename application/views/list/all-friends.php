<?php if (count($lists)) { ?>


<table class="zebra-striped">
	<thead>
		<tr>
			<th>List name</th>
			<th>Whose list?</th>
			<th>Total gifts</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lists as $list) { ?>
		<tr>
			<td>
				<a href="/list/friend/<?php echo $list->id; ?>">
					<?php echo HTML::chars($list->name); ?>
				</a>
			</td>
			<td><?php echo HTML::chars($list->owner->firstname . ' ' . $list->owner->surname); ?></td>
			<td style="text-align:right"><?php echo HTML::chars($list->total_gifts()); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<div class="well">
	<a class="btn" href="/friend/list">All friends</a>
</div>

<?php } ?>

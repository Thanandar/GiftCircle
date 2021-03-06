

<?php if (count($pending)) { ?>


<h3>Pending friend requests</h3>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th width="140"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pending as $friend) { ?>
		<tr>
			<td>
				<?php echo HTML::chars($friend->firstname) ?>
				<?php echo HTML::chars($friend->surname) ?>
			</td>
			<td><?php echo HTML::chars($friend->email) ?></td>
			<td>
				<input type="button" class="btn primary" value="Accept" onclick="location.href='/friend/request_accept/<?php echo $friend->id; ?>'" />
				or
				<a type="button" href="/friend/request_cancel/<?php echo $friend->id; ?>">ignore</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>


<?php } ?>




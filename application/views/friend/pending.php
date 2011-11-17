

<?php if (count($pending)) { ?>


<h3>Pending friend requests</h3>

<p>These people would like to be your friend.</p>

<table class="zebra-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th></th>
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
				<a type="button" onclick="return confirm('Are you sure you want to cancel this friend request?')" href="/friend/request_cancel/<?php echo $friend->id; ?>">cancel</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>


<?php } ?>




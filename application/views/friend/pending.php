

<?php if (count($pending)) { ?>


<h2>Pending friend requests</h2>

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
				<input type="button" class="btn success" value="Accept" onclick="location.href='/friend/accept/<?php echo $friend->id; ?>'" />
				<input type="button" class="btn danger" value="Cancel" onclick="location.href='/friend/cancel/<?php echo $friend->id; ?>'" />
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>


<?php } ?>




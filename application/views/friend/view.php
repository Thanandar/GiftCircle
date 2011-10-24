

<?php
$fullname = HTML::chars($friend->firstname . ' ' . $friend->surname);
?>

<div class="span12">

	<h2><?php echo $fullname; ?></h2>

	<dl>
		<dt>Email</dt>
		<dd><?php echo HTML::chars($friend->email) ?></dd>
		<dt>Birthday</dt>
		<dd><?php echo HTML::chars($friend->birthday) ?></dd>
		<dt>Address</dt>
		<dd><?php echo nl2br(HTML::chars($friend->address)) ?></dd>
		<dt>Friendship</dt>
		<dd><?php 
			if ($friend->is_confirmed()) {
				echo 'Confirmed';
			} else {
				echo 'Not confirmed';
			}
		 ?></dd>
	</dl>

	<div class="well">
		<input type="button" class="btn primary" onclick="location.href='/friend/edit/<?php echo $friend->id; ?>'" value="Edit" />
		<input type="button" class="btn danger" onclick="location.href='/friend/delete/<?php echo $friend->id; ?>'" value="Delete" />
	</div>

	<!-- <h2>Your lists that <?php echo $fullname; ?> is on</h2>

	<div class="warning alert-message">
		<b><?php echo $fullname; ?></b>
		is not on any of your lists yet.
	</div> -->

	<?php if ($friend_user) { ?>

		<h2><?php echo $fullname; ?>'s circles <!-- that you're on --></h2>
		<?php if (count($friends_lists)) { ?>
			
			<table class="zebra-striped">
				<thead>
					<tr>
						<th>List name</th>
						<th>Total gifts</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($friends_lists as $list) { ?>
					<tr>
						<td>
							<a href="/list/friend/<?php echo $list->id; ?>">
								<?php echo HTML::chars($list->name); ?>
							</a>
						</td>
						<td><?php echo HTML::chars($list->total_gifts()); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		<?php } else { ?>

			<div class="warning alert-message">
				<?php echo Message::e('friend', 'not-on-any-lists', $fullname) ?>
			</div>
		<?php } ?>

	<?php } else { ?>

		<div class="warning alert-message">
			<?php echo Message::e('friend', 'not-registered', $fullname) ?>
		</div>

	<?php } ?>

</div>

<div class="span4">
	<h2><?php echo Message::e('shopping', 'my-list') ?></h2>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
</div>





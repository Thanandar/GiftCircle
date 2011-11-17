

<?php
$fullname = HTML::chars($friend->firstname . ' ' . $friend->surname);
?>

<div class="span12">


<!-- <h3>Your lists that <?php echo $fullname; ?> is on</h3>

	<div class="warning alert-message">
		<b><?php echo $fullname; ?></b>
		is not on any of your lists yet.
	</div> -->

	<?php if ($friend_user) { ?>

		<h3><?php echo $fullname; ?></h3>
		<?php if (count($friends_lists)) { ?>
			
			<table class="zebra-striped sort">
				<thead>
					<tr>
						<th>List name</th>
						<th width="100">Expiry date</th>
						<th width="100">Total gifts</th>
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
						<td style="text-align:right"><?php echo HTML::chars($list->expiry); ?></td>
						<td style="text-align:right"><?php echo HTML::chars($list->total_gifts()); ?></td>
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
	<h3><?php echo Message::e('shopping', 'my-list') ?></h3>
	
	<?php echo Request::factory('gift/to_buy')->execute() ?>
</div>





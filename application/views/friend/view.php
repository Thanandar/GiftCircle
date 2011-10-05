

<?php
$fullname = HTML::chars($friend->firstname . ' ' . $friend->surname);
?>

<div class="span12">

	<h2><?php echo $fullname; ?></h2>

	<dl>
		<dt>Email</dt>
		<dd><?php echo HTML::chars($friend->email) ?></dd>
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
		<input type="button" class="btn danger" onclick="if (confirm('<?php echo HTML::chars(Kohana::message('friend', 'delete')) ?>')){location.href='/friend/delete/<?php echo $friend->id; ?>'}" value="Delete" />
	</div>

	<!-- <h2>Your lists that <?php echo $fullname; ?> is on</h2>

	<div class="warning alert-message">
		<b><?php echo $fullname; ?></b>
		is not on any of your lists yet.
	</div> -->

	<?php if ($friend_user) { ?>

	<h2><?php echo $fullname; ?>'s lists <!-- that you're on --></h2>

	<div class="warning alert-message">
		<?php echo Message::e('friend', 'not-on-any-lists', $fullname) ?>
	</div>

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






<div class="span12">

	<h2>My lists</h2>
	<?php echo $all_mine; ?>
	<div class="well">
		<input type="button" class="btn primary" value="New list" onclick="location.href='/list/add'"/>
	</div>

	<h2>My friends' lists</h2>
	<?php echo $all_friends; ?>

	<h2>My shopping list</h2>
	<?php echo $all_shopping; ?>

</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>



<div class="span12">

	<?php 
	echo View::factory('friend/pending')
		->set('pending', $pending);
	?>

	<h3>Your lists</h3>
	
	<?php 
	echo View::factory('list/all-mine')
		->set('lists', $my_lists);
	?>

	<div class="well">
		<input type="button" class="btn primary" value="New list" onclick="location.href='/list/add'"/>
		<?php if (count($my_lists)) { ?>
		<a class="btn" href="/list/my">All your lists</a>
		<?php } ?>
	</div>

	<?php if (count($friends_lists)) { ?>
	<h3>Most recently updated friends' lists</h3>

	<?php 
	echo View::factory('list/all-friends')
		->set('lists', $friends_lists);
	?>
	<?php } ?>

	<?php if (count($my_shopping_list)) { ?>
	<h3>Your shopping list</h3>

	<?php 
	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>

	<div class="well">
		<a class="btn" href="/gift/shopping">View all gifts on shopping list</a>
	</div>
	<?php } ?>



</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>


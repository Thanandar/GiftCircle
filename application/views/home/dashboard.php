
<div class="span12">

	<?php 
	echo View::factory('friend/pending')
		->set('pending', $pending);
	?>

	<h2>Your circles</h2>
	
	<?php 
	echo View::factory('list/all-mine')
		->set('lists', $my_lists);
	?>

	<div class="well">
		<input type="button" class="btn primary" value="New circle" onclick="location.href='/list/add'"/>

		<a class="btn" href="/list/my">All your circles</a>
	</div>

	<h2>Your friends' circles</h2>

	<?php 
	echo View::factory('list/all-friends')
		->set('lists', $friends_lists);
	?>
	<h2>Your shopping list</h2>

	<?php 
	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>

	<div class="well">
		<a class="btn" href="/gift/shopping">View all gifts on shopping list</a>
	</div>



</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>


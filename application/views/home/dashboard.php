
<div class="span12">

	<?php 
	echo View::factory('friend/pending')
		->set('pending', $pending);
	?>

	<h2>My lists</h2>
	
	<?php 
	echo View::factory('list/all-mine')
		->set('lists', $my_lists);
	?>

	<div class="well">
		<input type="button" class="btn primary" value="New list" onclick="location.href='/list/add'"/>

		<a class="btn" href="/list/my">All my lists</a>
	</div>

	<h2>My friends' lists</h2>

	<?php 
	echo View::factory('list/all-friends')
		->set('lists', $friends_lists);
	?>
	<h2>My shopping list</h2>

	<?php 
	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>


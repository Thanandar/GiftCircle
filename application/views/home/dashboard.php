
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
	<?php //echo View::factory('sidebar/faqs'); ?>
    
  <h3>Just got here?</h3>
  <p>To start organising your shopping click &ldquo;New List&rdquo; then  follow steps 1-4. And don&rsquo;t forget to create your own gift list!</p>
  <p>If someone invited you to join and make a gift list, accept  them as a friend and you&rsquo;re off. Create your gift list and add and invite more  people that you&rsquo;d like to exchange gifts with to join your circle.</p>
  <h3>Dashboard</h3>
  <p>Your Dashboard is your &ldquo;at a glance&rdquo; update of what&rsquo;s  happening in your circles. What events and celebrations coming up, who&rsquo;s  getting what and who wants what is all here.</p>
  <h3>Will Gift Circle  spoil my surprise?</h3>
  <p>No because <em>you</em> can&rsquo;t see what been bought off <em>your</em> gift list - clever huh? </p>
<h3>What about the little  people?</h3>
  <p>We want children to have fun making and sending lists to all their  brothers and sisters and all the relatives. Its up to you as parents to decide  whether to let them have their own account or let them have their own lists  under your account. This way you have control over who&rsquo;s invited to browse the  lists. Just create a new list for them to use and you choose who to invite to  view the list – simple.</p>
</div>


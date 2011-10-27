
<div class="span16">

	<?php 

	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>

	<?php 
	echo View::factory('list/all-bought')
		->set('gifts', $my_bought_list);
	?>

	<?php if (!count($my_shopping_list) && !count($my_bought_list)) { ?>

	<h2>You have an empty shopping list!</h2>

	<p>
		You haven't reserved any gifts yet. <a href="/friend/list">Why not get started now</a>.
	</p>

	<?php } ?>
</div>


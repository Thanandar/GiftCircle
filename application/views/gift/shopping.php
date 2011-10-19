
<div class="span12">

	<?php 
	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>
</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>



<div class="span12">

	<?php 
	echo View::factory('list/all-mine')
		->set('lists', $my_lists);
	?>

	<div class="well">
		<input type="button" class="btn primary" value="New circle" onclick="location.href='/list/add'"/>
	</div>

</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>


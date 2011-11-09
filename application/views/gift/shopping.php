
<div class="span12">

	<?php 

	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list);
	?>

	<?php 
	echo View::factory('list/all-bought')
		->set('gifts', $my_bought_list);
	?>

	<input class="btn" type="button" value="Clear selected bought gifts"
		onclick="alert('This will clear some of your bought gifts so you can budget better')" />

	<?php if (!count($my_shopping_list) && !count($my_bought_list)) { ?>

	<h2>You have an empty shopping list!</h2>

	<p>
		You haven't reserved any gifts yet. <a href="/friend/list">Why not get started now</a>.
	</p>

	<?php } ?>
</div>

<div class="span4">
	<h2>Budget</h2>

	<form action="" method="post">
		Your budget: 
		&pound; <input class="span1" type="text" name="budget" value="<?php echo $budget; ?>">
		<input type="submit" value="Update" class="btn" />
	</form>

	<?php if ($budget > 0) { ?>

	<ul>
		<li>Your budget: &pound;<?php echo $budget; ?></li>
		<li>Gifts left to buy: &pound;<?php echo $total_to_buy; ?></li>
		<li>Gifts bought: &pound;<?php echo $total_bought; ?></li>
		<li>
			Budget left:
			<span style="color:#<?php echo $budget_left ? '080' : '800'; ?>">
				&pound;<?php echo $budget_left; ?>
			</span>
		</li>
	</ul>

	<?php }?>

</div>


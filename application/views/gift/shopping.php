
<div class="span12">

	<?php 

	echo View::factory('list/all-shopping')
		->set('gifts', $my_shopping_list)
		->set('show_total', true)
		;
	?>

	<?php 
	echo View::factory('list/all-bought')
		->set('gifts', $my_bought_list)
		->set('show_total', true);
	?>

	<?php if (!count($my_shopping_list) && !count($my_bought_list)) { ?>

	<h3>You have an empty shopping list!</h3>

	<p>
		You haven't reserved any gifts yet. <a href="/friend/list">Why not get started now</a>.
	</p>

	<?php } ?>
</div>

<div class="span4">
	<h3>Budget</h3>

	<form action="" method="post">

	<table class="zebra-striped">
		<tr><td style="vertical-align:middle">Your budget</td>
			<td style="text-align:right">&pound; <input class="span1" type="text" name="budget" value="<?php echo $budget; ?>"></td>
		</tr>

		<tr><td>Gifts left to buy</td>
			<td style="text-align:right">&pound;<?php echo number_format($total_to_buy, 2); ?></td>
		</tr>
		<tr><td>Gifts bought</td>
			<td style="text-align:right">&pound;<?php echo number_format($total_bought, 2); ?></td>
		</tr>
		<tr>
			<td>Budget left</td>
			<td style="text-align:right"><span style="color:#<?php echo ($budget_left > 0) ? '080' : '800'; ?>">
							&pound;<?php echo number_format($budget_left, 2); ?>
						</span></td>
		</tr>
	</table>

		<div class="well"><input type="submit" value="Update budget" class="btn" /></div>
	</form>

</div>


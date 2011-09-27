
<div class="span12">

<h2>My lists</h2>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>List name</th>
				<th>Total items</th>
				<th>Friends in my circle</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><a href="/list/mine/1">30th birthday</a></td>
				<td>0</td>
				<td>8</td>
				<td><a href="#" onclick="return confirm('Are you sure you want to delete this list?')"><span class="label important">✘</span></a></td>
			</tr>
			<tr>
				<td><a href="/list/mine/2">31st birthday</a></td>
				<td>1</td>
				<td>2</td>
				<td><a href="#" onclick="return confirm('Are you sure you want to delete this list?')"><span class="label important">✘</span></a></td>
			</tr>
		</tbody>
	</table>

	<div class="well">
		<input type="button" class="btn primary" value="New list" onclick="location.href='/list/add'"/>
	</div>



	<h2>My friends' lists</h2>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th>List name</th>
				<th>Total items</th>
				<th>Who's list?</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><a href="/list/friend/1">Xmas</a></td>
				<td>10</td>
				<td><a href="/friend/view/1">Bob</a></td>
			</tr>
		</tbody>
	</table>

	<h2>My shopping list</h2>



	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Product name</th>
				<th>Approx price</th>
				<th>Who for?</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Coat</td>
				<td>&pound;50</td>
				<td>Bobby</td>
				<td>
					<a href="#" onclick="return confirm('Mark this item as bought?')"><span class="label success">✔</span></a> 
					<a href="#" onclick="return confirm('Are you sure you want to delete this product?')"><span class="label important">✘</span></a>
				</td>
			</tr>
		</tbody>
	</table>


</div>

<div class="span4">
	<?php echo View::factory('sidebar/faqs'); ?>
</div>


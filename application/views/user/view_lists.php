<?php echo View::factory('page/header'); ?>

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
				<td>30th birthday</td>
				<td>0</td>
				<td>8</td>
				<td>✘</td>
			</tr>
			<tr>
				<td>31st birthday</td>
				<td>1</td>
				<td>2</td>
				<td>✘</td>
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
				<td>✔ ✘</td>
			</tr>
		</tbody>
	</table>


</div>

<div class="span4">

	<h2>FAQs</h2>

	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

	<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

</div>

<?php echo View::factory('page/footer'); ?>

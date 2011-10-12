

<div class="span16">

<p>Are you sure you want mark <?php echo HTML::chars($gift->name) ?> as bought?</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn primary" value="Mark as bought" name="bought" />

		<a href="/gift/buy/<?php echo $gift->id ?>">cancel</a>
	</div>

</form>

</div>
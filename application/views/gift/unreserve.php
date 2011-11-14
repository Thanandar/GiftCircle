

<div class="span16">

<p>Are you sure you want to remove <?php echo HTML::chars($gift->name) ?> from your shopping list?</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn primary" value="Remove from list" name="unreserve" />
		or
		<a href="/gift/shopping">cancel</a>
	</div>

</form>

</div>
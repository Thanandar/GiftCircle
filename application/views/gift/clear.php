

<div class="span16">

<p>Are you sure you want to clear <?php echo HTML::chars($gift->name) ?> from your list?</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn primary" value="Clear" name="clear" />
		or
		<a href="/gift/shopping">cancel</a>
	</div>

</form>

</div>
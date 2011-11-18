

<div class="span16">

<h3>You Selected:</h3>

<p><big><?php echo HTML::chars($gift->name) ?></big></p>

<div class="alert-message warning">
	<p>Someone may have reserved or bought this gift.</p>
</div>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Confirm Delete" name="delete" />
		or
		<a href="/list/mine/<?php echo $gift->list_id ?>">cancel</a>
	</div>

</form>

</div>
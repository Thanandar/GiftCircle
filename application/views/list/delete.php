

<div class="span16">

<p>Are sure you want to delete the list
"<?php echo HTML::chars($list->name) ?>" ?
This will remove all gifts on this list too</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />

		<a href="/list/mine/<?php echo $list->id ?>">cancel</a>
	</div>

</form>

</div>
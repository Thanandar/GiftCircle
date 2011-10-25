

<div class="span16">

<p>Are sure you want to delete the circle
"<?php echo HTML::chars($list->name) ?>"?
This will remove your friends from the circle and all gifts from this list.
</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />

		or <a href="/list/mine/<?php echo $list->id ?>">cancel</a>
	</div>

</form>

</div>
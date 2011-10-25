

<div class="span16">

<p>Are you sure you want to remove <strong><?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?></strong> from your circle 
<strong><?php echo HTML::chars($list->name) ?></strong>?

They may have already bought you something.
</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />
		or
		<a href="/list/mine/<?php echo $list->id ?>">cancel</a>
	</div>

</form>

</div>
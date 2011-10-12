

<div class="span16">

<p>Are sure you want to delete the gift
"<?php echo HTML::chars($gift->name) ?>"
 from your list?</p>

<?php if ($gift->reserver_id) { ?>

<p>Someone may have already purchased this gift</p>

<?php } ?>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />

		<a href="/list/mine/<?php echo $gift->list_id ?>">cancel</a>
	</div>

</form>

</div>
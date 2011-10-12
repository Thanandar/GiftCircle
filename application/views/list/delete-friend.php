

<div class="span16">

<p>Are you sure you want to remove <?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?> from your list 
"<?php echo HTML::chars($list->name) ?>"?

<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?> might have already bought you something.
</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />

		<a href="/list/mine/<?php echo $list->id ?>">cancel</a>
	</div>

</form>

</div>
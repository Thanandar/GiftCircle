

<div class="span16">

<p>Are you sure you want to delete <?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?> from your friends list?

<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?> will be removed from all your lists and you will be removed from all 
<?php echo HTML::chars($friend->firstname . ' ' . $friend->surname) ?>'s lists.
</p>

<form action="" method="post">

	<div class="well">
		<input type="submit" class="btn danger" value="Delete" name="delete" />

		<a href="/friend/list">cancel</a>
	</div>

</form>

</div>
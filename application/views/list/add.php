
<div class="span12">

	<h2>Step 1</h2>

	<p>
		Give your list a name then add your friends.

		As soon as you're done adding people to your circle you can add gift ideas to your list.
	</p>

	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label>List name</label>
				<div class="input"><input name="name" placeholder="eg '30th Birthday'"></div>
			</div>

			<div class="clearfix">
				<label>Expiry date</label>
				<div class="input">
					<input name="expiry" placeholder="eg '25/12/2012'">
					<span class="help-inline">Optional</span>
				</div>
			</div>


			<?php
			if (!empty($errors)) {
				echo '<div class="alert-message error"><p>';
				echo $errors;
				echo '</p></div>';
			}
			?>

			<div class="actions">
				<input type="submit" value="Create your list" class="btn primary" /> or
				<a href="/list/my">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<h2>Quick help</h2>
	
	<ul class="unstyled steps">

		<li class="active">
			<strong>Step 1</strong>
			<p>Give your list a name.</p>
		</li>

		<li>
			<strong>Step 2</strong>
			<p>Add your friends.</p>
		</li>

		<li>
			<strong>Step 3</strong>
			<p>Get the browser button.</p>
		</li>

		<li>
			<strong>Step 4</strong>
			<p>Add gift ideas to your list.</p>
		</li>
	</ul>


</div>




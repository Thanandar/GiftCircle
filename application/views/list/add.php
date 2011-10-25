
<div class="span12">

	<h2>Step 1</h2>

	<p>
		There are 2 elements of a circle. Your friends and a list. First create the circle name and then add your friends. As soon as you're done adding the people in your circle you can add gift ideas to your list too if you want to.
	</p>

	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label>Name your gift circle</label>
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
				<input type="submit" value="Create your circle" class="btn primary" /> or
				<a href="/list/my">cancel</a>
			</div>
		</fieldset>
	</form>
</div>

<div class="span4">
	<h2>Create a circle</h2>

	<ol>
		<li><strong>Step 1</strong></li>
		<li>Step 2</li>
		<li>Step 3</li>
	</ol>

</div>




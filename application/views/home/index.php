
<div class="span16">

	<div class="row">
		<div class="span7">

			<img src="http://placehold.it/400x160&text=Logo" alt="" />
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

			<div class="well">
				<button type="button" class="btn primary large" onclick="location.href='/user/register'">Register </button>
				<span class="next-to-button">or
				<a href="/home/features">find out more</a></span>
			</div>
		</div>
		
		<div class="span9">
			<img src="http://placehold.it/520x290&text=Video" alt="" />
		</div>
	</div>

	<div class="row">
		<div class="span10">
			<h3>Why use Gift Circle?</h3>

			<div class="row">
				<div class="span5">
					<p>1</p> <p>2</p> <p>3</p>
				</div>
				<div class="span5">
					<p>4</p> <p>5</p> <p>6</p>
				</div>
			</div>

		</div>
		<div class="span6">
			<?php echo View::factory('sidebar/testimonials'); ?>
			
			<?php echo View::factory('sidebar/tweets'); ?>
		</div>
	</div>

</div>

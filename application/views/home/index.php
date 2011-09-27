<?php echo View::factory('page/header'); ?>

<div class="span16">

	<div class="row">
		<div class="span6">

			<img src="http://placehold.it/250x100&text=Logo" alt="" />
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

			<div class="well">
				<input type="button" class="btn primary large" value="Register" onclick="location.href='/user/register'" />
				or
				<a href="/home/features">find out more</a>
			</div>
		</div>
		
		<div class="span10">
			<img src="http://placehold.it/580x320&text=Video" alt="" />
		</div>
	</div>

	<div class="row">
		<div class="span10">
			<h3>Why user Gift Circle?</h3>

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
			<h3>Testimonials</h3>
			
			<blockquote>
				<p>Gift Circle is great!</p>
				<small>Bob</small>
			</blockquote>

			<h3>Tweets about us</h3>
			<ul>
				<li><a href="#">@bob</a>: I just used @GiftCircle</li>
			</ul>
		</div>
	</div>

</div>
<?php echo View::factory('page/footer'); ?>

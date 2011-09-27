<?php 

$logged_in = Auth::instance()->logged_in();

if ($logged_in) {
	$username = Auth::instance()->get_user()->username;
}

?>
<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="/">Gift Circle</a>
			<ul class="nav">
				<li><a href="/">Home</a></li>
				<?php if ($logged_in) { ?>
					<li><a href="/user/view_lists">Gift Lists</a></li>
					<li><a href="/friend/list">My Friends</a></li>
				<?php } else { ?>
				<?php } ?>
				<li><a href="/home/features">Features</a></li>
				<li><a href="/home/support">Support</a></li>
				<li><a href="/home/faqs">FAQs</a></li>
			</ul>

			<?php if ($logged_in) { ?>
				<form class="pull-right">
					<span class="currently-logged-in">Logged in as <strong>
					<?php echo $username; ?>
					</strong></span>&nbsp;
					<button onclick="location.href='/user/logout'" class="btn" type="button">Logout</button>
				</form>
			<?php } else { ?>
				<form class="pull-right" action="/user/login" method="post">
					<input name="email" class="input-small" type="text" placeholder="Email" />
					<input name="password" class="input-small" type="password" placeholder="Password" />
					<button class="btn" type="submit">Login</button>
					<button onclick="location.href='/user/register'" class="btn primary" type="button">Register</button>
				</form>
			<?php } ?>
				<ul>
				</ul>
			</nav>
		</div>
	</div>
</div>


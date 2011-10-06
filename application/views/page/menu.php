<?php 

$logged_in = Auth::instance()->logged_in();

if ($logged_in) {
	$user = Auth::instance()->get_user();
	$name = htmlspecialchars($user->firstname . ' ' . $user->surname);
	if (!strlen(trim($name))) {
		$name = $user->email;
	}
}

?>
<div class="topbar">
	<div class="fill">
		<div class="container">
			<?php if ($logged_in) { ?>
				<a class="brand" href="/home/dashboard">Gift Circle</a>
				<ul class="nav">
					<li><a href="/home/dashboard">Dashboard</a></li>
					<li><a href="/list/my">My Lists</a></li>
					<li><a href="/gift/shopping">My Shopping List</a></li>
					<li><a href="/friend/list">My Friends</a></li>
					<li><a href="/home/support">Support</a></li>
					<li><a href="/home/faqs">FAQs</a></li>
				</ul>
			<?php } else { ?>
				<a class="brand" href="/">Gift Circle</a>
				<ul class="nav">
					<li><a href="/home/features">Features</a></li>
					<li><a href="/home/support">Support</a></li>
					<li><a href="/home/faqs">FAQs</a></li>
				</ul>
			<?php } ?>

			<?php if ($logged_in) { ?>
				<form class="pull-right">
					<span class="currently-logged-in">Logged in as 
						<a href="/user/profile"><strong><?php echo $name; ?></strong></a>
					</span>&nbsp;
					<button onclick="location.href='/user/logout'" class="btn" type="button">Logout</button>
				</form>
			<?php } else { ?>
				<form class="pull-right" action="/user/login" method="post">
					<input name="username" class="input-small" type="text" placeholder="Email" />
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


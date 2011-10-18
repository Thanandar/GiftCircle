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
			<a class="brand" href="/home/dashboard">Gift Circle</a>
			
			<div class="pull-right">
				<ul class="nav">
			
				<?php if ($logged_in) { ?>
					<li><a href="/home/dashboard">Dashboard</a></li>
					<li><a href="/list/my">Lists</a></li>
					<li><a href="/gift/shopping">Shopping List</a></li>
					<li><a href="/friend/list">Friends</a></li>
					<li><a href="/home/support">Support</a></li>
					<li><a href="/home/faqs">FAQs</a></li>
					<li><a href="/user/logout">Logout</a></li>
				<?php } else { ?>
					<li><a href="/home/faqs"><span>What is Gift Circle?</span></a></li>
					<li><a href="/home/faqs"><span>FAQs</span></a></li>
					<li><a href="/user/login"><span>Login</span></a></li>
					<li><a href="/user/register"><span>Signup</span></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php if ($logged_in) { ?>
	<form class="pull-right">
		<span class="currently-logged-in">Logged in as 
			<a href="/user/profile"><strong><?php echo $name; ?></strong></a>
		</span>&nbsp;
	</form>
<?php } ?>
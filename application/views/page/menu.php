<?php 

$logged_in = Auth::instance()->logged_in();

function menu_link($url, $text) {
	$current = @$_SERVER['REQUEST_URI'];

	if (strpos($current, 'friend')) {
		$current = "/friend/list";
	}

	$dir = preg_replace('~/[a-z]+/?([0-9-]+)?$~', '', $current);
	
	if (strpos($current, 'shopping') || strpos($current, 'buy') || strpos($current, 'bought')) {
		$current = "/gift/shopping";
	} else {
		if ($dir == '/gift') {
			$current = "/list/my";
		}
	}


	if ($url == "/list/my" && $dir == '/list') {
		$current = "/list/my";
	}

	if ($url == "/friend/list" && $dir == '/friend') {
		$current = "/friend/list";
	}

	$active = strstr($current, $url) ? ' class="active"' : '';

	return '<li><a' . $active . ' href="' . $url . '"><span>' . $text . '</span></a></li>';
}


?>
<div class="topbar">
	<div class="fill">
		<div class="container">
        	<a class="brand" href="/home/"><img class="brand" src="/img/logo.png" alt="Gift Circle" /></a>
			
			<div class="pull-right">
				<ul class="nav">
			
				<?php

				if ($logged_in) {
					foreach (array(
						"/home/dashboard" => 'Dashboard',
						"/list/my"        => 'Circles',
						"/gift/shopping"  => 'Shopping List',
						"/friend/list"    => 'Friends\' Circles',
						"/home/support"   => 'Support',
						"/home/faqs"      => 'FAQs',
						"/user/logout"    => 'Logout',
						) as $url => $text) {
						echo menu_link($url, $text);
					}
				} else { 
					foreach (array(
						"/home/whatis"   => 'What is Gift Circle?',
						"/home/faqs"     => 'FAQs',
						"/user/login"    => 'Login',
						"/user/register" => 'Signup',
						) as $url => $text) {
						echo menu_link($url, $text);
					}
				} ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php 

$logged_in = Auth::instance()->logged_in();

function menu_link($url, $text) {
	$current = @$_SERVER['REQUEST_URI'];
	$class_text = strtolower($text);
	$class_text = preg_replace("/[^a-zA-Z0-9]/", "", $class_text);

	if ($current == '/' || $current == '/home/') {
		$current = '/home';
	}

	if (strpos($current, '/friend')) {
		$current = "/friend/list";
	}

	$dir = preg_replace('~/[a-z\_]+/?([0-9-]+)?$~', '', $current);
	
	if (strpos($current, 'shopping') || strpos($current, 'buy') || strpos($current, 'bought')) {
		$current = "/gift/shopping";
	} else {
		if ($dir == '/gift') {
			$current = "/list/my";
		}
	}

	if ($url == "/list/my" && $dir == '/list') {
		$current = true;
	}

	if ($url == "/friend/list" && $dir == '/friend') {
		$current = true;
	}

	if ($current != '/home' && $url == '/home') {

		$current = 'dfgdsfg';
	}

	$active = $current === true || (strpos($current, $url)  !== false) ? ' class="active"' : '';

	return '<li><a' . $active . ' href="' . $url . '"><span class="menu-item-'.$class_text.'">' . $text . '</span></a></li>';
}


?>
<div class="topbar">
	<div class="fill">
		<div class="container">
        	<a class="brand" href="/home/"><img class="brand" src="/img/logo-beta.png" alt="Gift Circle" /></a>
			
			<div class="pull-right">
				<ul class="nav">
			
				<?php

				if ($logged_in) {
					foreach (array(
						"/home/dashboard" => 'Dashboard',
						"/list/my"        => 'My Lists',
						"/gift/shopping"  => 'Shopping List',
						"/friend/list"    => 'Friends',
						"/home/faqs"      => 'FAQs',
						"/user/logout"    => 'Logout',
						) as $url => $text) {
						echo menu_link($url, $text);
					}
				} else { 
					foreach (array(
						"/home"              => 'Home',
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

<?php 

$logged_in = Auth::instance()->logged_in();

function menu_link($url, $text) {
	$active = strstr(@$_SERVER['REQUEST_URI'], $url) ? ' class="active"' : '';
	return '<li><a' . $active . ' href="' . $url . '"><span>' . $text . '</span></a></li>';
}


?>
<div class="topbar">
	<div class="fill">
		<div class="container">
        	<a class="brand" href="/home/dashboard"><img class="brand" src="/img/logo.png" alt="Gift Circle" /></a>
			
			<div class="pull-right">
				<ul class="nav">
			
				<?php

				if ($logged_in) {
					foreach (array(
						"/home/dashboard" => 'Dashboard',
						"/list/my"        => 'Lists',
						"/gift/shopping"  => 'Shopping List',
						"/friend/list"    => 'Friends',
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

<?php 

$browser = 'IE9'; // default

$uas = array(
	// in specific order
	'Gecko'    => 'Firefox',
	'Safari'   => 'Safari',
	'Chrome'   => 'Chrome',
	'MSIE'     => 'IE9',
	'MSIE 8.0' => 'IE8',
	'MSIE 7.0' => 'IE7',
);

foreach ($uas as $re => $ua) {
	if (preg_match('/'.$re.'/', @$_SERVER['HTTP_USER_AGENT'])) {
		$browser = $ua;
	}
}

$show_toolbar = array(
	'Firefox' => '<p>Right click on an empty area of the Firefox toolbar near the top of your screen, then check <code>Bookmarks Toolbar</code>. Alternatively, Press <code>Alt</code>, then <code>V</code>, then <code>T</code>, then <code>B</code>.</p>',

	'Chrome'  => '<p>Click on the wrench icon in the top right, go to <code>Bookmarks</code>, then check <code>Show Bookmarks Bar</code>. Alternatively, press <code>Ctrl + Shift + B</code> (Windows) or <code>Command + B</code> (Mac) at the same time.</p>',

	'Safari'   => '<p>Click on the gear icon in the top right, and tick <code>Show Bookmarks Toolbar</code>. Alternatively, Press <code>Command + B</code> (Mac) or <code>Ctrl + Shift + B</code> (Windows) at the same time.</p>',

	'IE9'     => '<p>Right click on an open area of the Internet Explorer menu near the top of your screen, then check <code>Favourites Bar</code>. Alternatively, Press <code>Alt</code>, click <code>View</code>, then <code>Toolbars</code>. Now click <code>Favorites Bar</code></p>',

	'IE8'     => '<p>Click <code>Tools</code>, then <code>Toolbars</code>. Now click <code>Favourites Bar</code>.</p>',
	
	'IE7'     => '<p>Click <code>Tools</code>, then <code>Toolbars</code>. Now click <code>Favourites Bar</code>.</p>',

);

$show_toolbar = $show_toolbar[$browser];

?>

<div class="span16">
<h2>Step 3</h2>

<p>
Browse the web as usual, then click the Gift Circle Browser Button when you see a gift you like. You don't even leave the page you're on!
<p>
</div>

<div class="span10">

<h3>Get the Browser Button</h3>

<ol>
	<li>
		<p>Make sure your bookmarks toolbar is enabled</p>
	</li>
	<li>
		<p>Drag this button to the bookmarks toolbar in your web browser</p>

<p><a href="javascript:(function(){jselem=document.createElement('SCRIPT');jselem.type='text/javascript';jselem.src='<?php echo URL::base('http'); ?>static/js/gc.js?'+(new Date()).getTime();document.getElementsByTagName('body')[0].appendChild(jselem);})();"  onclick="alert('Drag this button to your bookmarks toolbar');return false"><img src="/img/screen-grab/btn-<?php echo strtolower($browser); ?>.png" alt="Add to Gift Circle" /></a></p>
	</li>

	<li>
		<p>Click the button you just dragged to check it's working</p>
	</li>





</ol>

<img src="/img/screen-grab/drag-<?php echo strtolower($browser); ?>.png" alt="Help">




</div>

<div class="span6">

<h3>Can't see the bookmarks toolbar?</h3>

<p><?php echo $show_toolbar; ?></p>

<img src="http://placehold.it/300x100&text=<?php echo $browser; ?> toolbar" alt="Help">


</div>

<div class="span16">

	<div class="well">
	<a class="btn primary" href="/gift/browse/<?php echo $list_id; ?>">I've added the browser button</a>

	or <a href="/gift/browse/<?php echo $list_id; ?>">skip this step</a>

	</div>

</div>
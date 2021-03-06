<?php 

$browser = 'IE9'; // default

$uas = array(
	// in specific order
	'Gecko'    => 'Firefox',
	'Safari'   => 'Safari',
	'Chrome'   => 'Chrome',
	'MSIE'     => 'IE9', // or 10
	'MSIE 8.0' => 'IE8',
	'MSIE 7.0' => 'IE7',
);

foreach ($uas as $re => $ua) {
	if (preg_match('/'.$re.'/', @$_SERVER['HTTP_USER_AGENT'])) {
		$browser = $ua;
	}
}

// MS use "Favorites" instead of "Bookmarks"
$is_ie = in_array($browser, array("IE7", "IE8", "IE9"));

$show_toolbar = array(
	'Firefox' => '<p>Right click on an empty area of the Firefox toolbar near the top of your screen, then check <code>Bookmarks Toolbar</code>. Alternatively, Press <code>Alt</code>, then <code>V</code>, then <code>T</code>, then <code>B</code>.</p>',

	'Chrome'  => '<p>Click on the wrench icon in the top right, go to <code>Bookmarks</code>, then check <code>Show Bookmarks Bar</code>. Alternatively, press <code>Ctrl + Shift + B</code> (Windows) or <code>Command + B</code> (Mac) at the same time.</p>',

	'Safari'   => '<p>Click on the gear icon in the top right, and tick <code>Show Bookmarks Toolbar</code>. Alternatively, Press <code>Command + B</code> (Mac) or <code>Ctrl + Shift + B</code> (Windows) at the same time.</p>',

	'IE9'     => '<p>Right click on an open area of the Internet Explorer menu near the top of your screen, then check <code>Favorites Bar</code>. Alternatively, Press <code>Alt</code>, click <code>View</code>, then <code>Toolbars</code>. Now click <code>Favorites Bar</code></p>',

	'IE8'     => '<p>Click <code>Tools</code>, then <code>Toolbars</code>. Now click <code>Favorites Bar</code>.</p>',
	
	'IE7'     => '<p>Click <code>Tools</code>, then <code>Toolbars</code>. Now click <code>Favorites Bar</code>.</p>',

);

$show_toolbar = $show_toolbar[$browser];

?>

<div class="span16">
<?php if (strpos(@$_SERVER['HTTP_REFERER'], 'wizard')) { ?>
<h3>Step 3</h3>
<?php } ?>


<?php if ($is_ie) { ?>
    <p>Adding the browser button to your Favorites bar will allow you to search as usual and when you find a gift you like, add it to your gift list with one click. You don't even leave the page you're on!<p>
<?php } else { ?>
    <p>Adding the browser button to your Bookmark toolbar will allow you to search as usual and when you find a gift you like, add it to your gift list with one click. You don't even leave the page you're on!<p>
<?php } ?>

</div>

<div class="span10">

<h3>Get the Browser Button</h3>

<ol>
		<?php if (!$is_ie) { ?>
	<li>
 			<p>Make sure your Bookmarks toolbar is enabled.</p>
	</li>
		<?php } ?>
	<li>
		<p>
		<?php if ($is_ie) { ?>
			Right click on this button and select 'Add to favorites...'
		<?php } else { ?>
			Drag this button to the Bookmarks toolbar in your web browser
		<?php } ?>
		</p>

<p><a href="javascript:(function(){jselem=document.createElement('SCRIPT');jselem.type='text/javascript';jselem.src='<?php echo URL::base('http'); ?>static/js/gc.js?'+(new Date()).getTime();document.getElementsByTagName('body')[0].appendChild(jselem);})();"  onclick="alert('Drag this button to your <?php if ($is_ie) { ?>favorites<?php } else { ?>bookmarks<?php } ?> toolbar');return false"><img src="/img/screen-grab/btn-<?php echo strtolower($browser); ?>.png" alt="Add to Gift Circle" /></a></p>
	</li>

		<?php if ($is_ie) { ?>
	<li>
		<p>Select 'Favorites Bar' from the drop down and click 'Add'</p>
		<img src="/img/screen-grab/add-ie.png" alt="Help">
	</li>
		<?php } ?>

	<li>
		<?php if ($is_ie) { ?>
		<p>Click the button you just added to check it's working</p>
		<?php } else { ?>
		<p>Click the button you just dragged to check it's working</p>
		<?php } ?>
	</li>





</ol>

		<?php if (!$is_ie) { ?>
<img src="/img/screen-grab/drag-<?php echo strtolower($browser); ?>.png" alt="Help">
		<?php } ?>




</div>

<div class="span6">

	<?php if ($is_ie) { ?>
		<h3>Can't see the Favorites bar?</h3>
	<?php } else { ?>
		<h3>Can't see the Bookmarks toolbar?</h3>
	<?php } ?>

	<p><?php echo $show_toolbar; ?></p>

</div>

<div class="span16">

	<div class="well">
	<a class="btn primary" href="/gift/browse/<?php echo $list_id; ?>">I've added the browser button</a>

	or <a href="/gift/browse/<?php echo $list_id; ?>">skip this step</a>

	</div>

</div>
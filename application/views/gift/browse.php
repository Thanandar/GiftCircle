
<div class="span12">

	<h2>Browse for your item online (for '<?php echo HTML::chars($list->name); ?>')</h2>
	
	<div class="well">
		
		<ol>
			<!-- <li>
				If you don't have it already, drag this button to your bookmarks toolbar:

				<a href="javascript:(function(){jselem=document.createElement('SCRIPT');jselem.type='text/javascript';jselem.src='<?php echo URL::base('http'); ?>static/js/gc.js?'+(new Date()).getTime();document.getElementsByTagName('body')[0].appendChild(jselem);})();" class="btn" onclick="alert('Drag this button to your bookmarks toolbar');return false">Add to GiftCircle</a>
				
				<a href="#" onclick="alert('Just drag and drop');return false">Show me how</a>
			</li> -->

			<li>Start browsing using the logos below (links will open in a new window).</li>

			<li>When you've found a gift<!-- , click on the "Add to GiftCircle" button on your bookmarks toolbar or --> manually copy the details <a href="/gift/add/<?php echo $list->id; ?>">here</a>.</li>

		</ol>

	</div>

	<ul class="media-grid shop-logos">
		<?php foreach ($shops as $shop) { ?>
		<li>
			<a href="<?php echo HTML::chars($shop->url); ?>" target="_blank">
				<!--<img src="http://placehold.it/150x100&amp;text=<?php echo HTML::chars($shop->name); ?>" alt="<?php echo HTML::chars($shop->name); ?>" />-->
				<img src="<?php echo HTML::chars($shop->logo); ?>" alt="<?php echo HTML::chars($shop->name); ?>" title="<?php echo HTML::chars($shop->name); ?>" />
			</a>
		</li>
		<?php } ?>
	</ul>

</div>

<div class="span4">
	<h3>On your list</h3>
	<ul>
		<?php foreach ($other_gifts as $gift) { ?>
		<li>
			<?php echo HTML::chars($gift->name) ?>
		</li>
		<?php } ?>
	</ul>
</div>






	<h2>Browse for a gift</h2>

	<div class="well">
		<form>
			<div class="clearfix">
				<label>Category: </label>
				<div class="input" id="category_changer">
					<?php
					echo Form::select('category_id', $categories);
					?>
				</div>
			</div>
		</form>

	</div>
	
	<div class="merchants">

		<?php foreach ($categories as $cat_id => $category) { ?>
		<div id="cat-<?php echo $cat_id; ?>" style="display:none">
		<h2><?php echo HTML::chars($category) ?></h2>
		<!-- <ul class="media-grid shop-logos">
			<?php $i = 0; foreach ($shops as $shop) { if (++$i < $cat_id || $i > 50) continue; ?>
			<li>
				<a href="<?php echo HTML::chars($shop->url); ?>" target="_blank">
					<img src="<?php echo HTML::chars($shop->logo); ?>" alt="<?php echo HTML::chars($shop->name); ?>" title="<?php echo HTML::chars($shop->name); ?>" />
				</a>
			</li>
			<?php } ?>
		</ul> -->
		</div>
		<?php } ?>


	</div>

<script>
$(function() {
	
	/**
	 * Replace an element's HTML with the content of its first comment
	 */
	$.fn.commentToHTML = function() {
		var d = 'extracted-comments';

		return this.each(function(i, el) {
			var $el = $(this);

			if ($el.data(d)) {
				// comments have already been extracted
				// no need to do it again
				return;
			}

			var node = el.firstChild;
			while (node) {
				// found a HTML comment
				if (node.nodeType === 8) {
					this.innerHTML = node.nodeValue;
					$el.data(d, true);

					break;
				}
				node = node.nextSibling;
			}
		});
	}

	/**
	 * Replace an element's DOM nodes with a comment containing their HTML
	 */
	$.fn.deDOMify = function() {
		return this.each(function(i, el) {
			// TODO: this will break on HTML comments
			this.innerHTML = '<!--' + this.innerHTML + '-->';
		});
	}

	$('#category_changer select').change(function() {
		$('.merchants > div:visible').hide();
		$('#cat-' + $(this).val())
			.show()
			.commentToHTML();
		//alert($(this).val());
	});


	setTimeout(function() {
		//$('.merchants').commentToHTML();
	}, 500);
});

</script>


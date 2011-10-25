
<div class="span12">

	<h2>Step 4</h2>

	<ol>
		<li>Select a category</li>
		<li>Choose a shop from the selected category</li>
		<li>Find the gift you're after</li>
		<li>Use the browser button to add it to your list</li>
	</ol>

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

		<?php foreach ($departments as $department) { ?>
		<div id="cat-<?php echo $department->id; ?>" xstyle="display:none">
		<!-- 
		<h3><?php echo HTML::chars($department->name) ?></h3>
		<ul class="media-grid shop-logos">
			<?php foreach ($department->shops->find_all() as $shop) { ?>
			<li>
				<a href="<?php echo HTML::chars($shop->url); ?>" target="_blank">
					<img src="<?php echo HTML::chars($shop->logo); ?>" alt="<?php echo HTML::chars($shop->name); ?>" title="<?php echo HTML::chars($shop->name); ?>" />
				</a>
			</li>
			<?php } ?>
		</ul>
		-->
		</div>
		<?php } ?>

	</div>

</div>

<div class="span4">
<?php if (count($other_gifts)) { ?>
	<h3>On your list</h3>
	<table class="zebra-striped">
		<thead>
			<tr>
				<th width="180">Gift name</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($other_gifts as $gift) { ?>
			<tr>
				<td><a href="/gift/edit/<?php echo $gift->id; ?>"><?php echo $gift->name; ?></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="well">
		<a class="btn" href="/list/mine/<?php echo $list->id; ?>">Manage list</a>
	</div>

</div>
<?php } ?>





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
		Cufon.replace('h3', { fontFamily: 'HouschkaAltBlackRegular'});

		//alert($(this).val());
	});


	setTimeout(function() {
		//$('.merchants').commentToHTML();
	}, 500);
});

</script>


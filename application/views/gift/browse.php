
<div class="span12">

	<?php if (strpos(@$_SERVER['HTTP_REFERER'], 'bookmarklet')) { ?>
	<h2>Step 4</h2>
	<?php } ?>

	<p><a href="/gift/add/<?php echo $list->id; ?>">Enter details manually</a> if you know the gift details </p>

	<p>or</p>

	<ol class="darker">
		<li>Select a category to browse for a gift</li>
		<li>Choose a shop from the selected category</li>
		<li>Find the gift you're after</li>
		<li>Use the <a href="/gift/bookmarklet/<?php echo $list->id; ?>">browser button</a> to add it to your list </li> 
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
			<?php foreach ($department->shops->order_by('orderfield', 'DESC')->order_by('name', 'ASC')->find_all() as $shop) { ?>
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



<?php if (count($other_gifts)) { ?>
<div class="span4">
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
	}).change();


	setTimeout(function() {
		//$('.merchants').commentToHTML();
	}, 500);
});

</script>

<?php if (strpos(@$_SERVER['HTTP_REFERER'], 'bookmarklet')) { ?>

<div class="span4">
	<h2>Quick help</h2>

	<ul class="unstyled steps">

		<li>
			<strong>Step 1</strong>
			<p>Give your list a name.</p>
		</li>

		<li>
			<strong>Step 2</strong>
			<p>Add your friends.</p>
		</li>

		<li>
			<strong>Step 3</strong>
			<p>Get the browser button.</p>
		</li>

		<li class="active">
			<strong>Step 4</strong>
			<p>Add gift ideas to your list.</p>
		</li>
	</ul>
</div>

<?php } ?>

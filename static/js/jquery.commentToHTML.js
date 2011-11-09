/*global $ */

/**
 * Replace an element's HTML with the content if its first comment
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
				$el
					.html(node.nodeValue)
					.data(d, true);

				return;
			}
			node = node.nextSibling;
		}
	});
};

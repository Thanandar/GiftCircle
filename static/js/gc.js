/*global document, window, location, $ */



(function() {
	
if (window.giftcircle) {
	return;
}
window.giftcircle = true;


var scriptSource = (function() {
    var scripts = document.getElementsByTagName('script'), 
        script = scripts[scripts.length - 1]; 
    return script.src;
}());

var base = scriptSource.replace(/\/static.*/, '');

function loadScript(url, callback){

    var script = document.createElement("script");
    script.type = "text/javascript";

    if (script.readyState) {  //IE
        script.onreadystatechange = function() {
            if (script.readyState === "loaded" || script.readyState === "complete") {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function() {
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}

loadScript('http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js', function() {
	
	// for IE: body {height:100%;margin:0;padding:0;

	var overlay = $('<div></div>').css({
		position: 'absolute',
		left: 0,
		top: 0,
		width: '100%',
		height: '100%',
		zIndex: 99999,
		background: 'rgba(0, 0, 0, 0.5)'
	}).append('<div></div>');

	var url = base + '/bookmarklet/?u=' + encodeURIComponent(location.href);

	var inner = $('<div><iframe scrolling="no" border="0" width="100%" height="500" src="' + url + '"></iframe></div>').css({
		width: '700px',
		background: '#fff',
		margin: '100px auto',
		border: '0'
	});

	$('html,body')/*.css({
		height: '100%',
		margin: 0,
		padding: 0
	})*/.scrollTop(0);

	overlay.appendTo($('body')).append(inner);
	//overlay.append(inner).appendTo($('body'));

	window.onhashchange = function() {
		if (location.hash === "#GCclose") {
			window.giftcircle = null;
			overlay.remove();
			location.hash = '';
		}
	};
	

});


//alert(base);


}());


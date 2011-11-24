/*global document, window, location, $, setInterval */

if (window.argos) {
	String.prototype.trim = null;
}

(function() {
	
if (window.giftcircle) {
	return;
}

window.giftcircle = {};

var base = (function() {
		var scripts = document.getElementsByTagName('script'), 
			script = scripts[scripts.length - 1]; 
		return script.src.replace(/\/static.*/, '');
	}()),
	loadScript = function(url, callback){
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
	};

loadScript(base + '/static/js/bm/jquery-and-ui.min.js', function() {
	
	var css = {
			close:   'float:right;margin-right:30px;margin-top:10px;cursor: pointer;  display: inline-block;  background-color: #e6e6e6;  background-repeat: no-repeat;  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), color-stop(25%, #ffffff), to(#e6e6e6));  background-image: -webkit-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);  background-image: -moz-linear-gradient(top, #ffffff, #ffffff 25%, #e6e6e6);  background-image: -ms-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);  background-image: -o-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);  background-image: linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#ffffff\', endColorstr=\'#e6e6e6\', GradientType=0);  padding: 5px 14px 6px;  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);  color: #333;  font-size: 13px;  line-height: normal;  border: 1px solid #ccc;  border-bottom-color: #bbb;  -webkit-border-radius: 4px;  -moz-border-radius: 4px;  border-radius: 4px;  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);  -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);  -webkit-transition: 0.1s linear all;  -moz-transition: 0.1s linear all;  -ms-transition: 0.1s linear all;  -o-transition: 0.1s linear all;  transition: 0.1s linear all;',
			div:     'z-index:99999;position:absolute;top:20px;right:20px;width:470px;background:#fff;border:1px solid #000',
			dragbar: 'height:30px;background:#00f url(\'' + base + '/static/img/drag.png\');cursor:move',
			topbar:  'height:84px;background:#0083B1 url(\'' + base + '/img/header-bg.jpg\') repeat-x bottom',
			logo:    'padding:15px 0 0 40px;float:left;border:0'
		},

		url = base + '/bookmarklet/?u=' + encodeURIComponent(location.href),

		iframe = '<iframe frameborder="0" scrolling="no" border="0" width="100%" height="570" src="' + url + '"></iframe>',

		closebutton = $('<input onclick="window.giftcircle.closeiframe()" type="button" value="Close" style="' + css.close + '">'),

		dragbar = $('<div style="' + css.dragbar + '"></div>'),

		logo = '<a href="' + base + '"><img style="' + css.logo + '" src="' + base + '/img/logo-beta.png" alt="Gift Circle" /></a>',

		topbar = $('<div style="' + css.topbar + '"></div>')
				.append(dragbar)
				.append(logo)
				.append(closebutton),

		div = $('<div style="' + css.div + '"></div>')
				.append(topbar)
				.append(iframe)
				.draggable({
					handle: dragbar
				}),

		closeiframe = function() {
			window.giftcircle.div.remove();
			window.giftcircle = null;
			return false;
		};

	window.giftcircle.div = div;
	window.giftcircle.closeiframe = closeiframe;
	$('html,body').scrollTop(0);
	$('body').append(window.giftcircle.div);

});

}());


/*global Cufon, window, document, unescape, jQuery*/
/*jshint eqeqeq:true */

//Cufon
Cufon.replace('.topbar .nav a', { fontFamily: 'nevisBold' });
Cufon.replace('h2, h3', { fontFamily: 'HouschkaAltBlackRegular'});
Cufon.replace('.btn.large', { fontFamily: 'HouschkaAltBlackRegular', textShadow: '#444 1px 1px' });
Cufon.replace('h1.title', { fontFamily: 'HouschkaAltBlackRegular', textShadow: '#004369 1px 1px' });
Cufon.replace('.page-header h2', { fontFamily: 'VAGLight' });


function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)===' ') {
			c = c.substring(1,c.length);
		}
		if (c.indexOf(nameEQ) == 0) {
			return c.substring(nameEQ.length,c.length);
		}
	}
	return null;
}

function get_last_url_segment() {
	return location.pathname.split('/').pop();
}

jQuery(function($) {
	if ($().iToggle) {	
		$('#subscribe').iToggle({
			onClickOn: function() {
				$.get('/list/subscribe/' + get_last_url_segment());
			},
			onClickOff: function() {
				$.get('/list/unsubscribe/' + get_last_url_segment());
			}
		});
	}
	
	if ($().tablesorter) {
		$("html:not(.home-dashboard) table.sort").tablesorter({
			dateFormat: 'uk'
		});
	}

});


/**
 * @author Alexander Farkas
 * v. 1.22
 */


(function($) {
	if(!document.defaultView || !document.defaultView.getComputedStyle){ // IE6-IE8
		var oldCurCSS = $.curCSS;
		$.curCSS = function(elem, name, force){
			if(name === 'background-position'){
				name = 'backgroundPosition';
			}
			if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
				return oldCurCSS.apply(this, arguments);
			}
			var style = elem.style;
			if ( !force && style && style[ name ] ){
				return style[ name ];
			}
			return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
		};
	}
	
	var oldAnim = $.fn.animate;
	$.fn.animate = function(prop){
		if('background-position' in prop){
			prop.backgroundPosition = prop['background-position'];
			delete prop['background-position'];
		}
		if('backgroundPosition' in prop){
			prop.backgroundPosition = '('+ prop.backgroundPosition;
		}
		return oldAnim.apply(this, arguments);
	};
	
	function toArray(strg){
		strg = strg.replace(/left|top/g,'0px');
		strg = strg.replace(/right|bottom/g,'100%');
		strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
		var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
		return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
	}
	
	$.fx.step. backgroundPosition = function(fx) {
		if (!fx.bgPosReady) {
			var start = $.curCSS(fx.elem,'backgroundPosition');
			if(!start){//FF2 no inline-style fallback
				start = '0px 0px';
			}
			
			start = toArray(start);
			fx.start = [start[0],start[2]];
			var end = toArray(fx.end);
			fx.end = [end[0],end[2]];
			
			fx.unit = [end[1],end[3]];
			fx.bgPosReady = true;
		}
		//return;
		var nowPosX = [];
		nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
		nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];           
		fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];

	};
})(jQuery);




/*global jQuery*/

/*---------------
 * jQuery iToggle Plugin by Engage Interactive
 * Examples and documentation at: http://labs.engageinteractive.co.uk/itoggle/
 * Copyright (c) 2009 Engage Interactive
 * Version: 1.0 (10-JUN-2009)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.3 or later
---------------*/

(function($){
	$.fn.iToggle = function(options) {
		
		var clickEnabled = true;
		
		var defaults = {
			type: 'checkbox',
			keepLabel: true,
			easing: false,
			speed: 200,
			onClick: function(){},
			onClickOn: function(){},
			onClickOff: function(){},
			onSlide: function(){},
			onSlideOn: function(){},
			onSlideOff: function(){}
		},
		settings = $.extend({}, defaults, options);
		
		function label(e, id){
			if(e === true){
				if(settings.type === 'radio'){
					$('label[for='+id+']').addClass('ilabel_radio');
				}else{
					$('label[for='+id+']').addClass('ilabel');
				}
			}else{
				$('label[for='+id+']').remove();
			}
		}		

		function slide($object, radio){
			settings.onClick.call($object); //Generic click callback for click at any state
			var h=$object.innerHeight();
			var t=$object.attr('for');
			if($object.hasClass('iTon')){
				settings.onClickOff.call($object); //Click that turns the toggle to off position
				$object.animate({backgroundPosition:'-54px -'+h+'px'}, settings.speed, /*settings.easing,*/ function(){
					$object.removeClass('iTon').addClass('iToff');
					clickEnabled = true;
					settings.onSlide.call(this); //Generic callback after the slide has finnished
					settings.onSlideOff.call(this); //Callback after the slide turns the toggle off
				});
				$('input#'+t).removeAttr('checked');
			}else{
				settings.onClickOn.call($object);
				$object.animate({backgroundPosition:'0px -'+h+'px'}, settings.speed, /*settings.easing,*/ function(){
					$object.removeClass('iToff').addClass('iTon');
					clickEnabled = true;
					settings.onSlide.call(this); //Generic callback after the slide has finnished
					settings.onSlideOn.call(this); //Callback after the slide turns the toggle on
				});
				$('input#'+t).attr('checked','checked');
			}
			if(radio === true){
				var name = $('#'+t).attr('name');
				slide($object.siblings('label[for]'));
			}
		}

		this.each(function(){
			var $this = $(this);
			if($this.prop('tagName') === 'INPUT'){
				var id=$this.attr('id');
				label(settings.keepLabel, id);
				$this.addClass('iT_checkbox').before('<label class="itoggle" for="'+id+'"><span></span></label>');
				if($this.attr('checked')){
					$this.prev('label').addClass('iTon');
				}else{
					$this.prev('label').addClass('iToff');
				}
			}else{
				$this.children('input:'+settings.type).each(function(){
					var id = $(this).attr('id');
					label(settings.keepLabel, id);
					$(this).addClass('iT_checkbox').before('<label class="itoggle" for="'+id+'"><span></span></label>');
					if($(this).attr('checked')){
						$(this).prev('label').addClass('iTon');
					}else{
						$(this).prev('label').addClass('iToff');
					}
					if(settings.type === 'radio'){
						$(this).prev('label').addClass('iT_radio');
					}
				});
			}
		});


		$('label.itoggle').click(function(){
			if(clickEnabled === true){
				clickEnabled = false;
				if($(this).hasClass('iT_radio')){
					if($(this).hasClass('iTon')){
						clickEnabled = true;
					}else{
						slide($(this), true);
					}
				}else{
					slide($(this));
				}
			}
			return false;
		});
		$('label.ilabel').click(function(){
			if(clickEnabled === true){
				clickEnabled = false;
				slide($(this).next('label.itoggle'));
			}
			return false;
		});


	};
}(jQuery));
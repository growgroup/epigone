
(function($){
	$.fn.autoHeight = function(options){
		var op = $.extend({

			column  : 0,
			clear   : 0,
			height  : 'minHeight',
			reset   : ''
		},options || {}); // optionsに値があれば上書きする

		var self = $(this);
		if (op.reset === 'reset') {
			self.removeAttr('style');
		}

		// 要素の高さを取得
		var hList = self.map(function(){
			return $(this).height();
		}).get();
		var hListLine = [];
		if (op.column > 1) {
			for(var i = 0, l = hList.length; i < Math.ceil(l / op.column); i++) {
				var x = i * op.column;
				// 指定カラム数の配列を切り出し、その中の高さの最大値を取得する
				hListLine.push(Math.max.apply(null, hList.slice(x, x + op.column)));
			}
		}

		// 高さの最大値を要素に適用
		var ie6 = typeof window.addEventListener === "undefined" && typeof document.documentElement.style.maxHeight === "undefined";
		if (op.column > 1) {
			for (var j=0; j<hListLine.length; j++) {
				for (var k=0; k<op.column; k++) {
					if (ie6) {
						self.eq(j*op.column+k).height(hListLine[j]);
					} else {
						self.eq(j*op.column+k).css(op.height,hListLine[j]);
					}
					if (k === 0 && op.clear !== 0) {
						self.eq(j*op.column+k).css('clear','both');
					}
				}
			}
		} else {
			// 取得した高さの数値の最大値を取得
			var hMax = Math.max.apply(null, hList);
			if (ie6) {
				self.height(hMax);
			} else {
				self.css(op.height, hMax);
			}
		}
	};
})(jQuery);
(function($){
	"use strict";

	var Epigone = (new function(){
		var pageTop = function(){
			var trigger = $('#scroll-top a');
			trigger.on('click',function(e){
				e.preventDefault();
				$('body,html').animate({
					scrollTop : 0
				},500);
			});
		}

		var postListTile = function(){
			$('.hentry--tilecard').autoHeight({ column: 3});
		}

		var self = function(){
			pageTop();
			$(document).foundation();
			postListTile();
		};



		return self;

	});


	$(function(){
		window.epigone = new Epigone();
	});

})(jQuery);


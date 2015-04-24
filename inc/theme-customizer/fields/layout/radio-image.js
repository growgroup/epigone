/*!
 * Author: Yakir Sitbon.
 * Project Url: https://github.com/KingYes/jquery-radio-image-select
 * Author Website: http://www.yakirs.net/
 * Version: 1.0.1
 **/
/*!
 * Author: Yakir Sitbon.
 * Project Url: https://github.com/KingYes/jquery-radio-image-select
 * Author Website: http://www.yakirs.net/
 * Version: 1.0.1
 **/
(function($) {
	// Register jQuery plugin.
	$.fn.radioImageSelect = function( options ) {
		// Default var for options.
		var defaults = {
				imgItemClass: 'radio-select-img-item',
				imgItemCheckedClass: 'item-checked',
				hideLabel: true
			},

			/**
			 * Method firing when need to update classes.
			 */
				syncClassChecked = function( img ) {
				var radioName = img.prev('input[type="radio"]').attr('name');

				$('input[name="' + radioName + '"]').each(function() {
					// Define img by radio name.
					var myImg = $(this).next('img');

					// Add / Remove Checked class.
					if ( $(this).prop('checked') ) {
						myImg.addClass(options.imgItemCheckedClass);
					} else {
						myImg.removeClass(options.imgItemCheckedClass);
					}
					if ( !myImg.prop(options.imgItemCheckedClass) ) {
						 $(this).prop('checked',false);
					}
				});
			};

		// Parse args..
		options = $.extend( defaults, options );

		// Start jQuery loop on elements..
		return this.each(function() {

			$(this).hide().after('<img src="' + $(this).data('image') + '" alt="radio image" />');

			var img = $(this).next('img');
			img.addClass(options.imgItemClass);

			// Check if need to hide label connected.
			if ( options.hideLabel ) {
				$('label[for=' + $(this).attr('id') + ']').hide();
			}

			// When we are created the img and radio get checked, we need add checked class.
			if ( $(this).prop('checked') ) {
				img.addClass(options.imgItemCheckedClass);
			}

			// Create click event on img element.
			img.on('click', function(e) {
				var radioContainer = $(this).closest('ul');
				radioContainer.find('input[type="radio"]').attr('checked', false);
				$(this)
					// Prev to current radio input.
					.prev('input[type="radio"]')
					// Set checked attr.
					.attr('checked', true)
					// Run change event for radio element.
					.trigger('change');

				// Firing the sync classes.
				syncClassChecked($(this));
			} );
		});
	}
}) (jQuery);

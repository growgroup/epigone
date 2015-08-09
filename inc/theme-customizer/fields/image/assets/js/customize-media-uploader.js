(function ($) {
    "use strict";

    $(function () {

        function updateThumbnails(urls, args) {
            var input = args,
                thumbContainer = $(input.data('thumbs-container'));
            var urls = urls;
            // remove old images
            thumbContainer.empty();
            // for each image url in the value create and append an image element to the list
            for (var i = urls.length - 1; i >= 0; i--) {
                var li = $('<li/>');
                li.attr('style', 'background-image:url(' + urls[i] + ');');
                li.attr('class', 'thumbnail');
                li.attr('data-src', urls[i]);
                thumbContainer.append(li);
            }
        }

        // media uploader
        $(document).on('click', 'a.multi-images-upload', function (e) {
            e.preventDefault();
            var file_frame, thumbnails;
            var button = $(this);
            var inputId = $(this).data('store');

            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                button: $(this).data('uploader_button_text'),
                multiple: false,
                library: {
                    type: 'image'
                }
            });


            file_frame.on('select', function (e) {
                var selected = file_frame.state().get('selection').toJSON(),
                    store = $(inputId),
                    urls = [];

                for (var i = selected.length - 1; i >= 0; i--) {
                    urls.push(selected[i].url);
                }

                store.val(urls).trigger('change');
                updateThumbnails(urls, store);

            });
            // open the file frame
            file_frame.open();
        });

        $(document).on('click', 'a.multi-images-remove' ,function (e) {
            e.preventDefault();
            var button = $(this),
                input = $(button.data('store')),
                store = $(input);
            input.val('').trigger('change');
            updateThumbnails('', store);
        });
    });

})(jQuery);

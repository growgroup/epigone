/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.header-logo a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.header-description').text(to);
        });
    });

    // Header
    wp.customize('theme_mods_epigone[header_background_image]', function (value) {
        value.bind(function (to) {
            $('#masthead').css('background-image', 'url(' + to + ')');
        });
    });
    wp.customize('theme_mods_epigone[header_background_color]', function (value) {
        value.bind(function (to) {
            $('#masthead').css('background-color', to);
        });
    });
    wp.customize('theme_mods_epigone[header_background_attachment]', function (value) {
        value.bind(function (to) {
            $('#masthead').css('background-attachment', to);
        });
    });

    // Logo
    wp.customize('theme_mods_epigone[logo_color]', function (value) {
        value.bind(function (to) {
            $('.header-logo a').css('color', to);
        });
    });
    wp.customize('theme_mods_epigone[logo_font_size]', function (value) {
        value.bind(function (to) {
            $('.header-logo a').css('font-size', to + 'em');
        });
    });

    wp.customize('theme_mods_epigone[nav_background_color]', function (value) {
        value.bind(function (to) {
            $('.navbar-collapse>ul>li>a').css('background-color', to);
        });
    });

    wp.customize('theme_mods_epigone[nav_background_hover_color]', function (value) {
        value.bind(function (to) {
            $('.navbar-collapse>ul>li>a:hover').css('background-color', to);
            $('#header-navbar-collapse ul li a:hover').css('color', to);
        });
    });

    wp.customize('theme_mods_epigone[nav_background_active_color]', function (value) {
        value.bind(function (to) {
            $('.navbar-collapse>ul>li>a:active,.navbar-collapse>ul>li.current-menu-item a').css('background-color', to);
        });
    });


    // Body
    wp.customize('theme_mods_epigone[body_background_image]', function (value) {
        value.bind(function (to) {
            $('body').css('background-image', 'url(' + to + ')');
        });
    });
    wp.customize('theme_mods_epigone[body_background_color]', function (value) {
        value.bind(function (to) {
            $('body').css('background-color', to);
        });
    });
    wp.customize('theme_mods_epigone[body_background_attachment]', function (value) {
        value.bind(function (to) {
            $('body').css('background-attachment', to);
        });
    });
    wp.customize('theme_mods_epigone[body_background_size]', function (value) {
        value.bind(function (to) {
            $('body').css('background-size', to);
        });
    });

    // theme color
    wp.customize('theme_mods_epigone[theme_color]', function (value) {
        value.bind(function (to) {
            $('body').append('<div id="style-preview"></div>');
            $('#style-preview').html('');
            $('#style-preview').append('<style>.pagination .prev, .pagination .next,comment-title,pagination .prev, .pagination .next,.nav-links div,.widget-sidebar li:nth-child(even):hover,.widget-sidebar li:hover,.nav-links div:hover,.entry-meta .byline, .posted-on,.pagination .page-numbers.current,.widget-title:after,th,.archive .hentry.post:before, .search .hentry.post:before, .home .hentry.post:before' + '{background-color:' + to + ';}');
            $('#style-preview').append('<style>.entry-content a,.sidebar a,.breadcrumbs ul:before,.entry-header .entry-title:before' + '{color:' + to + ';}');
            $('.pagination .prev, .pagination .next,.nav-links div').css('border-color', to);
        });
    });

    wp.customize('theme_mods_epigone[button_color]', function (value) {
        value.bind(function (to) {
            $('.btn,input[type=submit],input[type=search],button').css('background-color', to);
        });
    });

    wp.customize('theme_mods_epigone[footer_background_image]', function (value) {
        value.bind(function (to) {
            $('.footer').css('background-image', to);
        });
    });

    wp.customize('theme_mods_epigone[footer_background_color]', function (value) {
        value.bind(function (to) {
            $('.footer').css('background-color', to);
        });
    });

    wp.customize('theme_mods_epigone[scroll_background_color]', function (value) {
        value.bind(function (to) {
            $('#scroll-top a').css('background-color', to);
        });
    });

    wp.customize('theme_mods_epigone[copyright_background]', function (value) {
        value.bind(function (to) {
            $('.footer-copyright').css('background-color', to);
        });
    });


    wp.customize('theme_mods_epigone[footer_background_attachment]', function (value) {
        value.bind(function (to) {
            $('.footer').css('background-attachment', to);
        });
    });


    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });
})(jQuery);

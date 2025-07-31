/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
    // Site title and description.
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });
    
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });
    
    // Contact information
    wp.customize('bitmages_email', function(value) {
        value.bind(function(to) {
            $('.footer-contact a[href^="mailto"]').text(to).attr('href', 'mailto:' + to);
        });
    });
    
    wp.customize('bitmages_phone', function(value) {
        value.bind(function(to) {
            $('.footer-contact a[href^="tel"]').text(to);
        });
    });
    
    wp.customize('bitmages_address', function(value) {
        value.bind(function(to) {
            $('.footer-contact p:has(.fa-map-marker-alt)').html('<i class="fas fa-map-marker-alt"></i> ' + to);
        });
    });
    
    wp.customize('bitmages_working_hours', function(value) {
        value.bind(function(to) {
            $('.working-hours').html('<i class="fas fa-clock"></i> ' + to);
        });
    });
    
    // Footer description
    wp.customize('bitmages_footer_description', function(value) {
        value.bind(function(to) {
            $('.footer-description').text(to);
        });
    });
    
    // Hero content
    wp.customize('bitmages_hero_title', function(value) {
        value.bind(function(to) {
            $('.hero-title').html('<span class="gradient-text">' + to + '</span>');
        });
    });
    
    wp.customize('bitmages_hero_description', function(value) {
        value.bind(function(to) {
            $('.hero-description').text(to);
        });
    });
    
    // Stats
    for (let i = 1; i <= 3; i++) {
        wp.customize('bitmages_stat_number_' + i, function(value) {
            value.bind(function(to) {
                $('.stat:nth-child(' + i + ') .stat-number').text(to);
            });
        });
        
        wp.customize('bitmages_stat_label_' + i, function(value) {
            value.bind(function(to) {
                $('.stat:nth-child(' + i + ') .stat-label').text(to);
            });
        });
    }
    
    // Social links
    const socialNetworks = ['linkedin', 'github', 'instagram', 'youtube', 'twitter', 'facebook'];
    
    socialNetworks.forEach(function(network) {
        wp.customize('bitmages_' + network, function(value) {
            value.bind(function(to) {
                const link = $('.social-links a[aria-label="' + network.charAt(0).toUpperCase() + network.slice(1) + '"]');
                if (to) {
                    link.attr('href', to).show();
                } else {
                    link.hide();
                }
            });
        });
    });
})(jQuery);
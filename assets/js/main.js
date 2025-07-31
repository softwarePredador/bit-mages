/**
 * Main JavaScript file for Bit Mages Theme
 * 
 * @package BitMages
 */

(function($) {
    'use strict';

    // Wait for DOM to be ready
    $(document).ready(function() {
        
        // Initialize all functions
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initAnimations();
        initContactForm();
        initPortfolioFilters();
        initBackToTop();
        initPreloader();
        initThemeToggle();
        initCounters();
        
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const $mobileToggle = $('.mobile-toggle');
        const $navMenu = $('.nav-menu');
        const $body = $('body');

        $mobileToggle.on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            $navMenu.toggleClass('active');
            $body.toggleClass('menu-open');
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.nav-wrapper').length) {
                $mobileToggle.removeClass('active');
                $navMenu.removeClass('active');
                $body.removeClass('menu-open');
            }
        });

        // Close menu when clicking on a link
        $('.nav-menu a').on('click', function() {
            $mobileToggle.removeClass('active');
            $navMenu.removeClass('active');
            $body.removeClass('menu-open');
        });
    }

    /**
     * Smooth Scroll
     */
    function initSmoothScroll() {
        $('a[href^="#"]:not([href="#"])').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'swing');
            }
        });
    }

    /**
     * Header Scroll Effects
     */
    function initHeaderScroll() {
        let lastScroll = 0;
        const $header = $('.header');
        const headerHeight = $header.outerHeight();

        $(window).on('scroll', function() {
            const currentScroll = $(window).scrollTop();

            // Add/remove scrolled class
            if (currentScroll > 10) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            // Hide/show header on scroll
            if (currentScroll > lastScroll && currentScroll > headerHeight) {
                $header.addClass('scroll-down').removeClass('scroll-up');
            } else if (currentScroll < lastScroll || currentScroll <= headerHeight) {
                $header.removeClass('scroll-down').addClass('scroll-up');
            }

            lastScroll = currentScroll;
        });
    }

    /**
     * Initialize Animations
     */
    function initAnimations() {
        // Intersection Observer for scroll animations
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            animatedElements.forEach(el => {
                animationObserver.observe(el);
            });
        } else {
            // Fallback for older browsers
            animatedElements.forEach(el => {
                el.classList.add('animated');
            });
        }

        // Add animation classes to elements
        $('.service-card').addClass('animate-on-scroll animate-fadeInUp');
        $('.portfolio-item').addClass('animate-on-scroll animate-fadeInUp');
        $('.process-step').addClass('animate-on-scroll animate-fadeInUp');
        $('.stat').addClass('animate-on-scroll animate-fadeIn');
    }

    /**
     * Contact Form Handler
     */
    function initContactForm() {
        $('#bitmages-contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $submitBtn = $form.find('button[type="submit"]');
            const $response = $form.find('.form-response');
            const formData = $form.serializeArray();
            
            // Create data object
            const data = {
                action: 'bitmages_contact',
                nonce: bitmages_ajax.nonce
            };
            
            // Add form fields to data
            formData.forEach(field => {
                data[field.name] = field.value;
            });
            
            // Disable submit button
            $submitBtn.prop('disabled', true).addClass('loading');
            $submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Enviando...');
            
            // Send AJAX request
            $.ajax({
                url: bitmages_ajax.ajax_url,
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $response.removeClass('error').addClass('success').html(response.data).show();
                        $form[0].reset();
                        
                        // Hide message after 5 seconds
                        setTimeout(function() {
                            $response.fadeOut();
                        }, 5000);
                    } else {
                        $response.removeClass('success').addClass('error').html(response.data || 'Erro ao enviar mensagem.').show();
                    }
                },
                error: function() {
                    $response.removeClass('success').addClass('error').html('Erro ao enviar mensagem. Por favor, tente novamente.').show();
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).removeClass('loading');
                    $submitBtn.html('Enviar Mensagem <i class="fas fa-paper-plane"></i>');
                }
            });
        });
    }

    /**
     * Portfolio Filters
     */
    function initPortfolioFilters() {
        const $filterButtons = $('.portfolio-filter');
        const $portfolioItems = $('.portfolio-item');

        $filterButtons.on('click', function() {
            const filter = $(this).data('filter');
            
            // Update active button
            $filterButtons.removeClass('active');
            $(this).addClass('active');
            
            // Filter items
            if (filter === 'all') {
                $portfolioItems.fadeIn();
            } else {
                $portfolioItems.each(function() {
                    if ($(this).data('category') === filter) {
                        $(this).fadeIn();
                    } else {
                        $(this).fadeOut();
                    }
                });
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        const $backToTop = $('<button class="back-to-top" aria-label="Voltar ao topo"><i class="fas fa-arrow-up"></i></button>');
        
        // Add button to body
        $('body').append($backToTop);
        
        // Show/hide button
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.addClass('show');
            } else {
                $backToTop.removeClass('show');
            }
        });
        
        // Scroll to top on click
        $backToTop.on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
        });
    }

    /**
     * Preloader
     */
    function initPreloader() {
        // Add preloader HTML
        const preloaderHTML = `
            <div class="preloader">
                <div class="preloader-inner">
                    <div class="preloader-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        `;
        
        $('body').prepend(preloaderHTML);
        
        // Hide preloader when page is loaded
        $(window).on('load', function() {
            $('.preloader').fadeOut(500, function() {
                $(this).remove();
            });
        });
        
        // Fallback: hide after 3 seconds
        setTimeout(function() {
            $('.preloader').fadeOut(500, function() {
                $(this).remove();
            });
        }, 3000);
    }

    /**
     * Theme Toggle (Light/Dark mode)
     */
    function initThemeToggle() {
        const $themeToggle = $('.theme-toggle');
        const $body = $('body');
        
        // Check for saved theme preference
        const currentTheme = localStorage.getItem('bitmages-theme') || 'dark';
        
        if (currentTheme === 'light') {
            $body.addClass('light-theme');
        }
        
        $themeToggle.on('click', function() {
            $body.toggleClass('light-theme');
            
            // Save preference
            const theme = $body.hasClass('light-theme') ? 'light' : 'dark';
            localStorage.setItem('bitmages-theme', theme);
        });
    }

    /**
     * Animated Counters
     */
    function initCounters() {
        const $counters = $('.stat-number');
        let hasAnimated = false;
        
        function animateCounters() {
            $counters.each(function() {
                const $this = $(this);
                const target = parseInt($this.text());
                
                $({ Counter: 0 }).animate({
                    Counter: target
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.ceil(this.Counter) + '+');
                    }
                });
            });
        }
        
        // Trigger animation when counters are in view
        $(window).on('scroll', function() {
            if (hasAnimated) return;
            
            const windowBottom = $(window).scrollTop() + $(window).height();
            const countersTop = $('.hero-stats').offset().top;
            
            if (windowBottom > countersTop) {
                hasAnimated = true;
                animateCounters();
            }
        });
    }

    /**
     * Utility Functions
     */
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Throttle function
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /**
     * Window Resize Handler
     */
    $(window).on('resize', debounce(function() {
        // Handle resize events
        if ($(window).width() > 968) {
            $('.nav-menu').removeClass('active');
            $('.mobile-toggle').removeClass('active');
            $('body').removeClass('menu-open');
        }
    }, 250));

})(jQuery);

/**
 * Additional CSS for JavaScript functionality
 */
const dynamicStyles = `
<style>
/* Preloader */
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--dark-bg);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preloader-inner {
    text-align: center;
}

.preloader-icon {
    display: inline-flex;
    gap: 5px;
}

.preloader-icon span {
    width: 10px;
    height: 10px;
    background: var(--primary-color);
    border-radius: 50%;
    display: inline-block;
    animation: preloader-bounce 1.4s infinite ease-in-out both;
}

.preloader-icon span:nth-child(1) {
    animation-delay: -0.32s;
}

.preloader-icon span:nth-child(2) {
    animation-delay: -0.16s;
}

@keyframes preloader-bounce {
    0%, 80%, 100% {
        transform: scale(0);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Back to Top */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    color: var(--dark-bg);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.25rem;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 999;
    box-shadow: var(--glow);
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,255,136,0.4);
}

/* Loading state */
.loading {
    position: relative;
    color: transparent !important;
}

.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid var(--primary-color);
    border-radius: 50%;
    border-top-color: transparent;
    animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
    to { transform: rotate(360deg); }
}

/* Animations */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.animate-on-scroll.animated {
    opacity: 1;
    transform: translateY(0);
}

/* Menu open state */
body.menu-open {
    overflow: hidden;
}

/* Header scrolled state */
.header.scrolled {
    background: rgba(10, 15, 10, 0.98);
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

/* Light theme adjustments */
body.light-theme {
    background: #f5f5f5;
    color: #333;
}

body.light-theme .header {
    background: rgba(255, 255, 255, 0.95);
}

body.light-theme .nav-link {
    color: #333;
}

body.light-theme .service-card {
    background: #fff;
    color: #333;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}
</style>
`;

// Inject dynamic styles
document.head.insertAdjacentHTML('beforeend', dynamicStyles);
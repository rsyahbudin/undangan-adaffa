@push('scripts')
<script>
    // Suppress console errors from external sources
    const originalConsoleError = console.error;
    console.error = function(...args) {
        // Filter out known external errors
        const message = args.join(' ');
        if (message.includes('play.google.com') ||
            message.includes('net::ERR_BLOCKED_BY_CLIENT') ||
            message.includes('Failed to load resource')) {
            return; // Suppress these errors
        }
        originalConsoleError.apply(console, args);
    };

    // Ensure all elements have classList property
    function ensureClassListSupport() {
        const allElements = document.querySelectorAll('*');
        allElements.forEach(element => {
            if (!element.classList) {
                Object.defineProperty(element, 'classList', {
                    get: function() {
                        return {
                            add: function() {},
                            remove: function() {},
                            contains: function() {
                                return false;
                            },
                            toggle: function() {}
                        };
                    }
                });
            }
        });
    }
</script>

<script>
    function getResponsiveDimensions() {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        if (windowWidth <= 480) {
            return {
                width: Math.min(windowWidth - 20, 400),
                height: Math.min(windowHeight * 0.8, 600)
            };
        } else if (windowWidth <= 768) {
            return {
                width: Math.min(windowWidth - 40, 500),
                height: Math.min(windowHeight * 0.75, 650)
            };
        } else {
            return {
                width: Math.min(windowWidth * 0.8, 800),
                height: Math.min(windowHeight * 0.85, 900)
            };
        }
    }

    function fixInteractiveElements() {
        const interactiveElements = document.querySelectorAll('.flipbook-page iframe, .flipbook-page input, .flipbook-page select, .flipbook-page textarea, .flipbook-page button, .flipbook-page a, .flipbook-page label');
        interactiveElements.forEach(element => {
            element.style.pointerEvents = 'auto';
            element.style.zIndex = '10';

            // Prevent flipbook from triggering on interactive elements
            element.addEventListener('click', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
            });

            element.addEventListener('mousedown', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
            });

            element.addEventListener('mouseup', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
            });
        });

        // Special handling for radio buttons
        const radioButtons = document.querySelectorAll('.flipbook-page input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.style.pointerEvents = 'auto';
            radio.style.zIndex = '20';
            radio.style.cursor = 'pointer';

            radio.addEventListener('change', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                console.log('Radio button clicked:', this.value);
            });
        });

        // Special handling for labels containing radio buttons
        const radioLabels = document.querySelectorAll('.flipbook-page label');
        radioLabels.forEach(label => {
            label.style.pointerEvents = 'auto';
            label.style.cursor = 'pointer';
            label.style.zIndex = '15';

            label.addEventListener('click', function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
            });
        });
    }

    function initPageFlip() {
        // Check if elements exist before initializing
        const flipbookElement = document.getElementById('flipbook');
        const flipbookPages = document.querySelectorAll('.flipbook-page');

        if (!flipbookElement) {
            console.error('Flipbook element not found');
            return null;
        }

        if (flipbookPages.length === 0) {
            console.error('No flipbook pages found');
            return null;
        }

        const dimensions = getResponsiveDimensions();
        const isMobile = window.innerWidth <= 768;

        const config = {
            width: dimensions.width,
            height: dimensions.height,
            maxShadowOpacity: 0.5,
            showCover: true,
            mobileScrollSupport: false
        };

        if (isMobile) {
            config.size = "stretch";
            config.minWidth = 315;
            config.maxWidth = 1000;
            config.minHeight = 420;
            config.maxHeight = 1350;
        }

        try {
            const pageFlip = new St.PageFlip(flipbookElement, config);
            pageFlip.loadFromHTML(flipbookPages);
            return pageFlip;
        } catch (error) {
            console.error('Error initializing PageFlip:', error);
            return null;
        }

        // Fix pointer events for interactive elements
        setTimeout(() => {
            fixInteractiveElements();
        }, 200);

        const rsvpForm = document.getElementById('rsvp-form');
        if (rsvpForm) {
            rsvpForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const attendance = document.querySelector('input[name="attendance"]:checked');
                const guestCount = document.getElementById('guest-count');
                const message = document.getElementById('message');

                if (!attendance) {
                    alert('Mohon pilih status kehadiran');
                    return;
                }

                alert('Terima kasih! Konfirmasi kehadiran Anda telah berhasil dikirim.');

                setTimeout(function() {
                    pageFlip.flipNext();
                }, 1000);
            });
        }

        return pageFlip;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure classList support first
        ensureClassListSupport();

        // Wait a bit for all elements to be loaded
        setTimeout(() => {
            let pageFlip = initPageFlip();

            if (!pageFlip) {
                console.warn('PageFlip initialization failed, retrying...');
                setTimeout(() => {
                    pageFlip = initPageFlip();
                }, 500);
            }

            window.addEventListener('resize', function() {
                if (pageFlip && typeof pageFlip.destroy === 'function') {
                    try {
                        pageFlip.destroy();
                    } catch (error) {
                        console.error('Error destroying PageFlip:', error);
                    }
                }

                setTimeout(() => {
                    pageFlip = initPageFlip();
                }, 100);
            });
        }, 100);
    });
</script>
@endpush
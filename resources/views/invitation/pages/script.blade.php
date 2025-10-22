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

    // Music autoplay handling with fallback
    let musicPlayed = false;
    let interactionListenersAdded = false;
    function initMusic() {
        const audio = document.getElementById('background-music');
        const toggleButton = document.getElementById('music-toggle');
        const playIcon = document.getElementById('play-icon');
        const pauseIcon = document.getElementById('pause-icon');

        if (!audio || !toggleButton || !playIcon || !pauseIcon) return;

        // Set initial icon states
        playIcon.style.display = 'block';
        pauseIcon.style.display = 'none';

        // Function to play music
        function playMusic() {
            audio.play().then(() => {
                musicPlayed = true;
                playIcon.style.display = 'none';
                pauseIcon.style.display = 'block';
                console.log('Music started playing');
                // Remove fallback listeners if they exist
                if (interactionListenersAdded) {
                    document.removeEventListener('click', playOnInteraction);
                    document.removeEventListener('touchstart', playOnInteraction);
                    interactionListenersAdded = false;
                }
            }).catch(error => {
                console.log('Play failed, waiting for user interaction:', error);
            });
        }

        // Function to pause music
        function pauseMusic() {
            audio.pause();
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        }

        // Toggle button events with comprehensive event prevention
        const toggleEvents = ['click', 'touchstart', 'touchend', 'mousedown', 'mouseup'];
        toggleEvents.forEach(eventType => {
            toggleButton.addEventListener(eventType, (e) => {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                if (audio.paused) {
                    playMusic();
                } else {
                    pauseMusic();
                }
            }, { passive: false });
        });

        // Attempt autoplay on load
        audio.volume = 0.5;
        playMusic();

        // Fallback: Play on first user interaction anywhere on the page (excluding button)
        function playOnInteraction(e) {
            // Don't trigger if clicking on the toggle button
            if (e.target.closest('#music-toggle')) return;
            
            if (!musicPlayed) {
                playMusic();
                document.removeEventListener('click', playOnInteraction);
                document.removeEventListener('touchstart', playOnInteraction);
                interactionListenersAdded = false;
            }
        }

        // Add fallback only if autoplay failed (check after a short delay)
        setTimeout(() => {
            if (!musicPlayed && !interactionListenersAdded) {
                document.addEventListener('click', playOnInteraction, { passive: true });
                document.addEventListener('touchstart', playOnInteraction, { passive: true });
                interactionListenersAdded = true;
                console.log('Fallback interaction listeners added');
            }
        }, 100);

        // Update button state when audio state changes
        audio.addEventListener('play', () => {
            playIcon.style.display = 'none';
            pauseIcon.style.display = 'block';
        });

        audio.addEventListener('pause', () => {
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        });

        // Handle audio ended event
        audio.addEventListener('ended', () => {
            pauseMusic();
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

    // Image Preloader Function
    function preloadImages(imageUrls) {
        return Promise.all(imageUrls.map(url => {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(url);
                img.onerror = () => reject(url);
                img.src = url;
            });
        }));
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure classList support first
        ensureClassListSupport();

        // Collect all image URLs to preload
        const imagesToPreload = [
            @if($settings && $settings->cover_photo)
            "{{ Storage::url($settings->cover_photo) }}",
            @endif
            @if($wedding->bride_photo)
            "{{ Storage::url($wedding->bride_photo) }}",
            @endif
            @if($wedding->groom_photo)
            "{{ Storage::url($wedding->groom_photo) }}",
            @endif
            @foreach($galleries as $gallery)
            @if($gallery->file_path)
            "{{ asset('storage/' . $gallery->file_path) }}",
            @endif
            @endforeach
            @if(!$settings || !$settings->cover_photo)
            "{{ asset('images/bride.jpg') }}",
            "{{ asset('images/groom.jpg') }}",
            @endif
        ].filter(url => url); // Remove empty strings

        // Initialize music controls
        initMusic();

        // Preload images and initialize everything
        preloadImages(imagesToPreload).then(() => {
            console.log('All images preloaded successfully');

            // Hide loading overlay with fade effect
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.transition = 'opacity 0.5s ease-out';
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }

            // Initialize PageFlip after preloading
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

        }).catch(error => {
            console.error('Error preloading images:', error);
            // Still initialize even if some images fail
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'none';
            }

            // Initialize PageFlip anyway
            let pageFlip = initPageFlip();
        });
    });
</script>
@endpush
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
            }, {
                passive: false
            });
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
                document.addEventListener('click', playOnInteraction, {
                    passive: true
                });
                document.addEventListener('touchstart', playOnInteraction, {
                    passive: true
                });
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
            // Mobile: smaller, more compact
            return {
                width: Math.min(windowWidth - 20, 350),
                height: Math.min(windowHeight * 0.9, 500)
            };
        } else if (windowWidth <= 768) {
            // Tablet: medium size
            return {
                width: Math.min(windowWidth - 40, 500),
                height: Math.min(windowHeight * 0.85, 650)
            };
        } else {
            // Desktop: larger, but not too big
            return {
                width: Math.min(windowWidth * 0.6, 700),
                height: Math.min(windowHeight * 0.8, 900)
            };
        }
    }

    function preventPageScroll() {
        // Prevent page scrolling when interacting with flipbook
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';

        // Prevent touch scrolling on mobile
        document.addEventListener('touchmove', preventTouchScroll, {
            passive: false
        });
    }

    function allowPageScroll() {
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        document.removeEventListener('touchmove', preventTouchScroll);
    }

    function preventTouchScroll(e) {
        if (e.target.closest('.st-pageflip')) {
            e.preventDefault();
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
            config.minWidth = 280;
            config.maxWidth = 600;
            config.minHeight = 400;
            config.maxHeight = 800;
        }

        try {
            const pageFlip = new St.PageFlip(flipbookElement, config);
            pageFlip.loadFromHTML(flipbookPages);

            // Prevent page scrolling
            preventPageScroll();

            return pageFlip;
        } catch (error) {
            console.error('Error initializing PageFlip:', error);
            return null;
        }

        // Fix pointer events for interactive elements
        setTimeout(() => {
            fixInteractiveElements();
        }, 200);

        // Special handling for RSVP form elements
        const rsvpForm = document.getElementById('rsvp-form');
        if (rsvpForm) {
            const formElements = rsvpForm.querySelectorAll('input, select, textarea, button');
            formElements.forEach(element => {
                element.style.pointerEvents = 'auto';
                element.style.zIndex = '9999';

                // Prevent flipbook events on form interactions
                ['click', 'touchstart', 'touchmove', 'mousedown', 'mouseup', 'change', 'input', 'focus', 'blur'].forEach(eventType => {
                    element.addEventListener(eventType, function(e) {
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                    }, {
                        passive: false
                    });
                });
            });

            // Special handling for pagination buttons
            const paginationButtons = document.querySelectorAll('#pagination button');
            paginationButtons.forEach(button => {
                button.style.pointerEvents = 'auto';
                button.style.zIndex = '9999';

                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                }, {
                    passive: false
                });
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

    // Swipe instruction function
    function initSwipeInstruction(pageFlip) {
        let instructionTimeout;
        let instructionElement;
        let hasInteracted = false;

        function showSwipeInstruction() {
            // Remove existing instruction if any
            if (instructionElement) {
                instructionElement.remove();
            }

            // Create instruction element with better visibility
            instructionElement = document.createElement('div');
            instructionElement.className = 'fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-3 rounded-full text-sm md:text-base font-semibold z-50 shadow-lg border-2 border-white/20';
            instructionElement.innerHTML = '👆 Swipe left/right to navigate pages';
            instructionElement.style.animation = 'bounce 1s infinite, fadeIn 0.5s ease-out';
            instructionElement.style.boxShadow = '0 4px 12px rgba(0,0,0,0.3)';

            // Add CSS animations
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes bounce {
                    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
                    40% { transform: translateX(-50%) translateY(-10px); }
                    60% { transform: translateX(-50%) translateY(-5px); }
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateX(-50%) scale(0.8); }
                    to { opacity: 1; transform: translateX(-50%) scale(1); }
                }
            `;
            document.head.appendChild(style);

            document.body.appendChild(instructionElement);

            // Auto-hide after 8 seconds
            setTimeout(() => {
                if (instructionElement) {
                    instructionElement.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                    instructionElement.style.opacity = '0';
                    instructionElement.style.transform = 'translateX(-50%) scale(0.8)';
                    setTimeout(() => {
                        if (instructionElement) {
                            instructionElement.remove();
                            instructionElement = null;
                        }
                    }, 800);
                }
            }, 8000);
        }

        function resetTimer() {
            clearTimeout(instructionTimeout);
            if (!hasInteracted) {
                instructionTimeout = setTimeout(() => {
                    // Show instruction immediately after load if no interaction
                    showSwipeInstruction();
                }, 100); // Show immediately after load
            }
        }

        function markAsInteracted() {
            hasInteracted = true;
            clearTimeout(instructionTimeout);
            if (instructionElement) {
                instructionElement.style.transition = 'opacity 0.5s ease-out';
                instructionElement.style.opacity = '0';
                setTimeout(() => {
                    if (instructionElement) {
                        instructionElement.remove();
                        instructionElement = null;
                    }
                }, 500);
            }
        }

        // Start timer on page load
        resetTimer();

        // Mark as interacted on any user interaction
        ['click', 'touchstart', 'touchmove', 'keydown', 'scroll'].forEach(event => {
            document.addEventListener(event, markAsInteracted, {
                passive: true
            });
        });

        // Mark as interacted when page changes
        if (pageFlip) {
            pageFlip.on('flip', markAsInteracted);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure classList support first
        ensureClassListSupport();

        // Collect all image URLs to preload
        const imagesToPreload = [
            @if($settings && $settings -> cover_photo)
            "{{ Storage::url($settings->cover_photo) }}",
            @endif
            @if($wedding -> bride_photo)
            "{{ Storage::url($wedding->bride_photo) }}",
            @endif
            @if($wedding -> groom_photo)
            "{{ Storage::url($wedding->groom_photo) }}",
            @endif
            @foreach($galleries as $gallery)
            @if($gallery -> file_path)
            "{{ asset('storage/' . $gallery->file_path) }}",
            @endif
            @endforeach
            @if(!$settings || !$settings -> cover_photo)
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

            initSwipeInstruction(pageFlip);

            if (!pageFlip) {
                console.warn('PageFlip initialization failed, retrying...');
                setTimeout(() => {
                    pageFlip = initPageFlip();
                    initSwipeInstruction(pageFlip);
                }, 500);
            }

            window.addEventListener('resize', function() {
                if (pageFlip && typeof pageFlip.destroy === 'function') {
                    try {
                        pageFlip.destroy();
                        allowPageScroll();
                    } catch (error) {
                        console.error('Error destroying PageFlip:', error);
                    }
                }

                setTimeout(() => {
                    pageFlip = initPageFlip();
                    initSwipeInstruction(pageFlip);
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

            initSwipeInstruction(pageFlip);
        });
    });
</script>
@endpush
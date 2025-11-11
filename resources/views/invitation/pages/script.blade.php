@push('scripts')
<script>
    // Performance optimized console error suppression
    const originalConsoleError = console.error;
    console.error = function(...args) {
        const message = args.join(' ');
        if (message.includes('play.google.com') ||
            message.includes('net::ERR_BLOCKED_BY_CLIENT') ||
            message.includes('Failed to load resource')) {
            return;
        }
        originalConsoleError.apply(console, args);
    };

    // Optimized classList support check (only check once)
    let classListSupported = true;

    function ensureClassListSupport() {
        if (!classListSupported) return;
        try {
            document.body.classList.add('test');
            document.body.classList.remove('test');
        } catch (e) {
            classListSupported = false;
            // Only patch if necessary
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
    }

    // Optimized music handling with reduced DOM queries
    let musicPlayed = false;
    let interactionListenersAdded = false;
    let audioElement, toggleButton, playIcon, pauseIcon;

    function initMusic() {
        // Cache DOM elements
        audioElement = document.getElementById('background-music');
        toggleButton = document.getElementById('music-toggle');
        playIcon = document.getElementById('play-icon');
        pauseIcon = document.getElementById('pause-icon');

        if (!audioElement || !toggleButton || !playIcon || !pauseIcon) return;

        // Set initial states
        playIcon.style.display = 'block';
        pauseIcon.style.display = 'none';

        // Optimized play function
        function playMusic() {
            audioElement.play().then(() => {
                musicPlayed = true;
                playIcon.style.display = 'none';
                pauseIcon.style.display = 'block';
                if (interactionListenersAdded) {
                    document.removeEventListener('click', playOnInteraction);
                    document.removeEventListener('touchstart', playOnInteraction);
                    interactionListenersAdded = false;
                }
            }).catch(() => {
                // Silent fail for autoplay
            });
        }

        // Optimized pause function
        function pauseMusic() {
            audioElement.pause();
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        }

        // Single event listener with debouncing
        let isProcessingToggle = false;
        toggleButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            if (isProcessingToggle) return;
            isProcessingToggle = true;

            if (audioElement.paused || audioElement.currentTime === 0) {
                playMusic();
            } else {
                pauseMusic();
            }

            setTimeout(() => {
                isProcessingToggle = false;
            }, 200);
        }, {
            passive: false
        });

        // Attempt autoplay
        audioElement.volume = 0.5;
        playMusic();

        // Optimized fallback interaction
        function playOnInteraction(e) {
            if (e.target.closest('#music-toggle')) return;
            if (!musicPlayed) {
                playMusic();
                document.removeEventListener('click', playOnInteraction);
                document.removeEventListener('touchstart', playOnInteraction);
                interactionListenersAdded = false;
            }
        }

        // Add fallback with delay
        setTimeout(() => {
            if (!musicPlayed && !interactionListenersAdded) {
                document.addEventListener('click', playOnInteraction, {
                    passive: true
                });
                document.addEventListener('touchstart', playOnInteraction, {
                    passive: true
                });
                interactionListenersAdded = true;
            }
        }, 100);

        // Optimized audio state listeners
        audioElement.addEventListener('play', () => {
            playIcon.style.display = 'none';
            pauseIcon.style.display = 'block';
        });

        audioElement.addEventListener('pause', () => {
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
        });

        audioElement.addEventListener('ended', pauseMusic);
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

    // Optimized interactive elements setup with cached selectors
    let interactiveElementsCached = null;
    let radioButtonsCached = null;
    let radioLabelsCached = null;

    function fixInteractiveElements() {
        if (!interactiveElementsCached) {
            interactiveElementsCached = document.querySelectorAll('.flipbook-page iframe, .flipbook-page input, .flipbook-page select, .flipbook-page textarea, .flipbook-page button, .flipbook-page a, .flipbook-page label');
        }
        if (!radioButtonsCached) {
            radioButtonsCached = document.querySelectorAll('.flipbook-page input[type="radio"]');
        }
        if (!radioLabelsCached) {
            radioLabelsCached = document.querySelectorAll('.flipbook-page label');
        }

        // Batch style updates
        const styles = 'pointer-events:auto;z-index:10;';
        interactiveElementsCached.forEach(element => {
            element.style.cssText += styles;
            element.addEventListener('click', stopPropagation, {
                passive: false
            });
            element.addEventListener('mousedown', stopPropagation, {
                passive: false
            });
            element.addEventListener('mouseup', stopPropagation, {
                passive: false
            });
        });

        // Radio buttons
        radioButtonsCached.forEach(radio => {
            radio.style.cssText += 'pointer-events:auto;z-index:20;cursor:pointer;';
            radio.addEventListener('change', stopPropagation, {
                passive: false
            });
        });

        // Labels
        radioLabelsCached.forEach(label => {
            label.style.cssText += 'pointer-events:auto;cursor:pointer;z-index:15;';
            label.addEventListener('click', stopPropagation, {
                passive: false
            });
        });
    }

    // Shared event handler
    function stopPropagation(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
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

    // Optimized swipe instruction with reduced DOM manipulation
    let instructionElement = null;
    let instructionTimeout = null;
    let hasInteracted = false;
    let fadeInStyle = null;

    function initSwipeInstruction(pageFlip) {
        function showSwipeInstruction() {
            if (instructionElement) return;

            instructionElement = document.createElement('div');
            instructionElement.className = 'fixed top-4 right-4 bg-gradient-to-r from-gray-800 to-gray-700 text-white px-4 py-3 rounded-xl text-xs md:text-sm font-medium z-50 shadow-2xl border border-gray-600 backdrop-blur-sm';
            instructionElement.innerHTML = `
                <div class="flex items-center gap-2">
                    <span class="text-lg">↔️</span>
                    <div class="flex flex-col">
                        <span class="font-semibold">Swipe to navigate</span>
                        <span class="text-gray-300 text-xs">or double-click edges</span>
                    </div>
                </div>
            `;
            instructionElement.style.cssText = 'animation:fadeIn 0.5s ease-out;max-width:200px;box-shadow:0 4px 20px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.1);';

            // Add fadeIn animation once
            if (!fadeInStyle) {
                fadeInStyle = document.createElement('style');
                fadeInStyle.innerHTML = '@keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }';
                document.head.appendChild(fadeInStyle);
            }

            document.body.appendChild(instructionElement);

            // Auto-hide after 8 seconds
            setTimeout(() => {
                if (instructionElement) {
                    instructionElement.style.cssText += 'transition:opacity 0.8s ease-out, transform 0.8s ease-out;opacity:0;transform:translateX(-50%) scale(0.8);';
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
                instructionTimeout = setTimeout(showSwipeInstruction, 100);
            }
        }

        function markAsInteracted() {
            hasInteracted = true;
            clearTimeout(instructionTimeout);
            if (instructionElement) {
                instructionElement.style.cssText += 'transition:opacity 0.5s ease-out;opacity:0;';
                setTimeout(() => {
                    if (instructionElement) {
                        instructionElement.remove();
                        instructionElement = null;
                    }
                }, 500);
            }
        }

        resetTimer();

        // Optimized event listeners
        const events = ['click', 'touchstart', 'touchmove', 'keydown', 'scroll'];
        events.forEach(event => {
            document.addEventListener(event, markAsInteracted, {
                passive: true,
                once: true
            });
        });

        if (pageFlip) {
            pageFlip.on('flip', markAsInteracted);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure classList support first
        ensureClassListSupport();

        // Collect critical images to preload (only first few for faster loading)
        const criticalImagesToPreload = [
            @if($settings && $settings -> cover_photo)
            "{{ Storage::url($settings->cover_photo) }}",
            @endif
            @if($wedding -> bride_photo)
            "{{ Storage::url($wedding->bride_photo) }}",
            @endif
            @if($wedding -> groom_photo)
            "{{ Storage::url($wedding->groom_photo) }}",
            @endif
            @if($galleries -> first() && $galleries -> first() -> file_path)
            "{{ asset('storage/' . $galleries->first()->file_path) }}",
            @endif
        ].filter(url => url);

        // Initialize music controls early
        initMusic();

        // Preload only critical images for faster initial load
        preloadImages(criticalImagesToPreload).then(() => {
            // Hide loading overlay immediately after critical images load
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.transition = 'opacity 0.3s ease-out';
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 300);
            }

            // Initialize PageFlip after critical preloading
            let pageFlip = initPageFlip();
            initSwipeInstruction(pageFlip);

            if (!pageFlip) {
                setTimeout(() => {
                    pageFlip = initPageFlip();
                    initSwipeInstruction(pageFlip);
                }, 300);
            }

            // Optimized resize handler with debouncing
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
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
                }, 250);
            });

        }).catch(() => {
            // Initialize immediately if preloading fails
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'none';
            }

            let pageFlip = initPageFlip();
            initSwipeInstruction(pageFlip);
        });
    });
</script>
@endpush
<!-- Gallery Page -->
<div
    x-data="{ activeImage: null }"
    class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white"
    style="background-image:
        radial-gradient(circle at 25% 75%, rgba(120,119,198,0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(255,119,198,0.03) 0%, transparent 50%);
        background-color: rgb(251 247 220);">

    <!-- Border Frame -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8 lg:py-10 relative z-10 flex-1 flex flex-col justify-center">

        <div class="w-full md:max-w-lg lg:max-w-xl mx-auto">

            <!-- Title -->
            <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
                style="font-family: 'Playfair Display', serif;">
                Our Gallery
            </h1>
            <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-3 md:mb-4"></div>
            <p class="text-gray-600 italic text-xs md:text-sm lg:text-base mb-2  px-2 md:px-0"
                style="font-family: 'Playfair Display', serif;">
                "Every picture tells a story, every moment is a memory to cherish forever."
            </p>

            <div class="flex-1 overflow-y-auto px-3 md:px-4 lg:px-6 py-2 md:py-3">

                {{-- ✅ Optimized Desktop Grid with Lazy Loading --}}
                <div class="hidden sm:grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-3 select-none">
                    @foreach($galleries->skip(1) as $gallery)
                    @if($gallery->file_path)
                    <div
                        class="relative bg-white/70 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-500 group cursor-pointer interactive-zone lazy-image-container"
                        @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                        @touchstart.stop
                        @touchmove.stop>

                        <img data-src="{{ asset('storage/' . $gallery->file_path) }}"
                            alt="Wedding Gallery"
                            loading="lazy"
                            class="lazy-image w-full h-28 md:h-32 lg:h-28 object-cover group-hover:scale-110 transition-transform duration-700 ease-out pointer-events-auto opacity-0"
                            style="will-change: transform;">
                        <div class="lazy-placeholder absolute inset-0 bg-gray-200 animate-pulse rounded-lg"></div>
                    </div>
                    @endif
                    @endforeach
                </div>

                {{-- ✅ Optimized Mobile Carousel with Lazy Loading --}}
                <div class="sm:hidden relative w-full">
                    <div class="swiper myGallery interactive-zone" style="touch-action: pan-y;">
                        <div class="swiper-wrapper">
                            @foreach($galleries->skip(1) as $gallery)
                            @if($gallery->file_path)
                            <div class="swiper-slide lazy-image-container" style="will-change: transform;">
                                <img data-src="{{ asset('storage/' . $gallery->file_path) }}"
                                    alt="Gallery Image"
                                    loading="lazy"
                                    class="lazy-image w-full h-96 md:h-52 lg:h-56 object-cover rounded-xl shadow-md cursor-pointer pointer-events-auto opacity-0"
                                    @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                                    @touchstart.stop
                                    @touchmove.stop>
                                <div class="lazy-placeholder absolute inset-0 bg-gray-200 animate-pulse rounded-xl flex items-center justify-center">
                                    <div class="w-8 h-8 border-2 border-gray-400 border-t-transparent rounded-full animate-spin"></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <!-- Pagination & Nav -->
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

                @if($galleries->isEmpty())
                <p class="text-gray-500 italic mt-8 md:mt-10 text-xs md:text-sm lg:text-base">No photos have been added yet 📸</p>
                @endif
            </div>
        </div>
    </div>

    {{-- ✅ Lightbox Popup --}}
    <template x-if="activeImage">
        <div
            class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 interactive-zone"
            @click.away="activeImage = null"
            @touchstart.stop
            @touchmove.stop>
            <img :src="activeImage" class="max-h-[75vh] md:max-h-[80vh] max-w-[85vw] md:max-w-[90vw] rounded-lg shadow-lg border border-white/20">
            <button @click="activeImage = null" class="absolute top-4 md:top-5 right-4 md:right-5 text-white text-xl md:text-2xl">×</button>
        </div>
    </template>
</div>

<style>
    /* ✅ Ubah warna tombol Swiper */
    .swiper-button-prev,
    .swiper-button-next {
        color: white !important;
        text-shadow: 0 0 6px rgba(0, 0, 0, 0.4);
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        color: #e5e5e5 !important;
        transform: scale(1.1);
    }

    /* ✅ Ubah warna pagination bullet */
    .swiper-pagination-bullet {
        background-color: rgba(255, 255, 255, 0.6);
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: white;
    }
</style>

<!-- ✅ Optimized Swiper Init Script with Lazy Loading -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize optimized Intersection Observer for lazy loading
        const imageObserver = new IntersectionObserver((entries, observer) => {
            // Process entries in batches to reduce CPU usage
            requestAnimationFrame(() => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.dataset.src;
                        if (src && !img.src) { // Only load if not already loaded
                            img.src = src;
                            img.onload = () => {
                                img.style.opacity = '1';
                                const placeholder = img.parentElement.querySelector('.lazy-placeholder');
                                if (placeholder) {
                                    placeholder.style.display = 'none';
                                }
                            };
                            img.onerror = () => {
                                // Hide placeholder on error too
                                const placeholder = img.parentElement.querySelector('.lazy-placeholder');
                                if (placeholder) {
                                    placeholder.style.display = 'none';
                                }
                            };
                            observer.unobserve(img);
                        }
                    }
                });
            });
        }, {
            rootMargin: '100px 0px', // Increased margin for earlier loading
            threshold: 0.01 // Lower threshold for earlier detection
        });

        // Observe all lazy images
        document.querySelectorAll('.lazy-image').forEach(img => {
            imageObserver.observe(img);
        });

        // Optimized Swiper init for mobile performance
        const swiper = new Swiper(".myGallery", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 4000, // Slightly longer delay to reduce CPU usage
                disableOnInteraction: true, // Stop autoplay on interaction
                pauseOnMouseEnter: false, // No mouse enter on mobile
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true, // Better performance with dynamic bullets
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            // Optimized touch settings for mobile
            touchRatio: 2, // Reduced from 3 for better control
            threshold: 5, // Slightly higher threshold
            touchAngle: 45, // More restrictive angle
            grabCursor: false, // Disable grab cursor for performance
            preventClicks: false,
            preventClicksPropagation: false,
            resistance: true, // Enable resistance for better UX
            resistanceRatio: 0.85, // Standard resistance
            shortSwipes: true,
            longSwipes: true,
            longSwipesRatio: 0.2, // Higher ratio for easier long swipes
            longSwipesMs: 150, // Slightly longer detection time
            // Performance optimizations
            watchSlidesProgress: false, // Disable progress watching
            preloadImages: false, // Don't preload swiper images (we handle lazy loading)
            updateOnImagesReady: false, // Don't wait for images
            // Hardware acceleration
            cssMode: false, // Use JS mode for better control
            effect: 'slide', // Standard slide effect
        });

        // Optimized event handling for interactive zones
        const safeZones = document.querySelectorAll('.interactive-zone');
        const stopPropagation = e => e.stopPropagation();

        safeZones.forEach(zone => {
            ['click', 'mousedown', 'mouseup', 'mousemove', 'touchstart', 'touchmove', 'touchend'].forEach(eventName => {
                zone.addEventListener(eventName, stopPropagation, {
                    passive: false
                });
            });
        });
    });
</script>
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

                {{-- ✅ Desktop Grid --}}
                <div class="hidden sm:grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-3 select-none">
                    @foreach($galleries->skip(1) as $gallery)
                    @if($gallery->file_path)
                    <div
                        class="relative bg-white/70 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-500 group cursor-pointer interactive-zone"
                        @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                        @touchstart.stop
                        @touchmove.stop>

                        <img src="{{ asset('storage/' . $gallery->file_path) }}"
                            alt="Wedding Gallery"
                            loading="eager"
                            class="w-full h-28 md:h-32 lg:h-28 object-cover group-hover:scale-110 transition-transform duration-700 ease-out pointer-events-auto"
                            style="will-change: transform;">
                    </div>
                    @endif
                    @endforeach
                </div>

                {{-- ✅ Mobile Carousel --}}
                <div class="sm:hidden relative w-full">
                    <div class="swiper myGallery interactive-zone" style="touch-action: pan-y;">
                        <div class="swiper-wrapper">
                            @foreach($galleries->skip(1) as $gallery)
                            @if($gallery->file_path)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $gallery->file_path) }}"
                                    alt="Gallery Image"
                                    loading="eager"
                                    class="w-full h-96 md:h-52 lg:h-56 object-cover rounded-xl shadow-md cursor-pointer pointer-events-auto"
                                    @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                                    @touchstart.stop
                                    @touchmove.stop
                                    style="will-change: transform;">
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

<!-- ✅ Swiper Init Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Swiper init
        new Swiper(".myGallery", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            touchRatio: 3, // Further increase touch sensitivity
            threshold: 3, // Even lower threshold for very easy swipe detection
            touchAngle: 60, // More angle tolerance for swipes
            grabCursor: true, // Show grab cursor on mobile
            preventClicks: false, // Allow clicks to work
            preventClicksPropagation: false, // Don't prevent click propagation
            resistance: false, // Disable resistance for smoother swipes
            resistanceRatio: 0, // No resistance ratio
            shortSwipes: true, // Allow short swipes
            longSwipes: true, // Allow long swipes
            longSwipesRatio: 0.1, // Low ratio for long swipes
            longSwipesMs: 100, // Quick long swipe detection
        });

        // ✅ Matikan PageFlip event di area interaktif
        const safeZones = document.querySelectorAll('.interactive-zone');
        safeZones.forEach(zone => {
            ['click', 'mousedown', 'mouseup', 'mousemove', 'touchstart', 'touchmove', 'touchend'].forEach(eventName => {
                zone.addEventListener(eventName, e => {
                    e.stopPropagation();
                }, {
                    passive: false
                });
            });
        });
    });
</script>
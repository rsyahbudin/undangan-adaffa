<!-- Gallery Page -->
<div
    x-data="{ activeImage: null }"
    class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 25% 75%, rgba(120,119,198,0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(255,119,198,0.03) 0%, transparent 50%);">

    <!-- Border Frame -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>


    <!-- Title -->
    <h2 class="text-2xl md:text-4xl font-extrabold tracking-wide uppercase mt-4 mb-1 md:mb-2"
        style="font-family: 'Playfair Display', serif;">
        Our Gallery
    </h2>
    <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>
    <p class="text-gray-600 italic text-sm md:text-base mb-3 md:mb-5 px-2 md:px-0"
        style="font-family: 'Playfair Display', serif;">
        “Every picture tells a story, every moment is a memory to cherish forever.”
    </p>

    <div class="flex-1 overflow-y-auto px-3 md:px-6 py-4 md:py-2">

        {{-- ✅ Desktop Grid --}}
        <div class="hidden sm:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4 select-none">
            @foreach($galleries as $gallery)
            <div
                class="relative bg-white/70 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-500 group cursor-pointer interactive-zone"
                @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                @touchstart.stop
                @touchmove.stop>

                @if($gallery->video_url)
                <iframe src="{{ $gallery->video_url }}"
                    class="w-full h-48 md:h-52 object-cover rounded-lg pointer-events-auto"
                    allowfullscreen loading="eager"></iframe>
                @else
                <img src="{{ asset('storage/' . $gallery->file_path) }}"
                    alt="Wedding Gallery"
                    loading="eager"
                    class="w-full h-48 md:h-56 object-cover group-hover:scale-110 transition-transform duration-700 ease-out pointer-events-auto"
                    style="will-change: transform;">
                @endif
            </div>
            @endforeach
        </div>

        {{-- ✅ Mobile Carousel --}}
        <div class="sm:hidden relative w-full">
            <div class="swiper myGallery interactive-zone" style="touch-action: pan-y;">
                <div class="swiper-wrapper">
                    @foreach($galleries as $gallery)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $gallery->file_path) }}"
                            alt="Gallery Image"
                            loading="eager"
                            class="w-full h-72 object-cover rounded-xl shadow-md cursor-pointer pointer-events-auto"
                            @click.stop="activeImage = '{{ asset('storage/' . $gallery->file_path) }}'"
                            @touchstart.stop
                            @touchmove.stop
                            style="will-change: transform;">
                    </div>
                    @endforeach
                </div>
                <!-- Pagination & Nav -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        @if($galleries->isEmpty())
        <p class="text-gray-500 italic mt-10 text-sm md:text-base">No photos have been added yet 📸</p>
        @endif
    </div>

    {{-- ✅ Lightbox Popup --}}
    <template x-if="activeImage">
        <div
            class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 interactive-zone"
            @click.away="activeImage = null"
            @touchstart.stop
            @touchmove.stop>
            <img :src="activeImage" class="max-h-[80vh] max-w-[90vw] rounded-lg shadow-lg border border-white/20">
            <button @click="activeImage = null" class="absolute top-5 right-5 text-white text-2xl">×</button>
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
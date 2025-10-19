<!-- Thank You Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-[#fdfaf5]"
    style="background-image:
        radial-gradient(circle at 40% 60%, rgba(218,165,32,0.05) 0%, transparent 50%),
        radial-gradient(circle at 60% 40%, rgba(255,215,0,0.05) 0%, transparent 50%);
        font-family: 'Playfair Display', serif;">

    <!-- Frame -->
    <div class="absolute inset-3 border border-amber-400/30 rounded-lg shadow-inner pointer-events-none"></div>

    <div class="container mx-auto px-5 py-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <!-- Left Column (Text Section) -->
        <div class="text-center md:text-left px-2">
            <h2 class="text-2xl md:text-3xl text-amber-800 mb-3 font-[Dancing Script]">
                Terima Kasih
            </h2>

            <p class="text-sm md:text-base text-gray-700 mb-4 leading-relaxed">
                Atas kehadiran dan doa restu yang telah Bapak/Ibu/Saudara/i berikan,
                kami ucapkan terima kasih yang sebesar-besarnya.
            </p>

            <div class="bg-white/80 p-3 md:p-4 rounded-md shadow-sm mb-4 border-l-4 border-amber-500">
                <p class="text-xs md:text-sm text-gray-700 italic leading-snug">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri,
                    supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.
                    Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                </p>
                <p class="text-xs text-gray-600 mt-1">QS. Ar-Rum: 21</p>
            </div>

            <div>
                <p class="text-xs md:text-sm text-gray-700 mb-2">
                    Semoga Allah SWT senantiasa melimpahkan rahmat, taufik, dan hidayah-Nya kepada kita semua.
                </p>
                <p class="text-sm md:text-base text-gray-800 font-semibold">
                    {{ $wedding->bride_name }} & {{ $wedding->groom_name }}
                </p>
            </div>
        </div>

        <!-- Right Column (Video Section) -->
        <div class="relative rounded-xl overflow-hidden shadow-md border border-amber-200/50 bg-white/50">
            @php
            $video = $wedding->galleries->whereNotNull('video_url')->first();
            @endphp

            @if ($video)
            @php
            $videoUrl = $video->video_url;
            $videoId = null;

            // Ambil ID dari berbagai format URL YouTube
            if (preg_match('/youtu\.be\/([^\?&]+)/', $videoUrl, $matches)) {
            $videoId = $matches[1];
            } elseif (preg_match('/v=([^\?&]+)/', $videoUrl, $matches)) {
            $videoId = $matches[1];
            } elseif (preg_match('/embed\/([^\?&]+)/', $videoUrl, $matches)) {
            $videoId = $matches[1];
            }
            @endphp

            @if ($videoId)
            <div class="relative w-full pb-[56.25%]"> <!-- Responsive 16:9 -->
                <iframe
                    class="absolute top-0 left-0 w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&showinfo=0&autoplay=0"
                    title="Prewedding Video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
            @else
            <p class="text-gray-500 text-sm italic p-3">Format URL video tidak valid</p>
            @endif
            @else
            <p class="text-gray-500 text-sm italic p-3">Belum ada video prewed</p>
            @endif
        </div>

    </div>

    <!-- Footer Floral Decoration -->
    <div class="absolute bottom-4 left-4 text-amber-500/10 text-2xl">🌼</div>
    <div class="absolute bottom-4 right-4 text-amber-500/10 text-2xl">🌸</div>
</div>
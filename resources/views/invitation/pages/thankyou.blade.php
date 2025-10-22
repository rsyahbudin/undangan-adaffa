<!-- Thank You Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 25% 75%, rgba(120,119,198,0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(255,119,198,0.03) 0%, transparent 50%);">

    <!-- Border Frame -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Decorative Elements -->

    <div class="flex-1 flex flex-col justify-center px-4 md:px-8 py-6 md:py-8">

        <!-- Title -->
        <h2 class="text-2xl md:text-4xl font-extrabold tracking-wide uppercase mt-4 mb-1 md:mb-2"
            style="font-family: 'Playfair Display', serif;">
            Thank You
        </h2>
        <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>



        <!-- Message -->
        <div class="max-w-lg md:max-w-xl mx-auto mb-6 md:mb-8">
            <p class="text-sm md:text-lg text-gray-700 leading-relaxed mb-3 md:mb-4 italic"
                style="font-family: 'Playfair Display', serif;">
                "We would like to express our deepest gratitude for your presence and the heartfelt prayers you have given. Your attendance is a true joy and honor for us."
            </p>
            <p class="text-xs md:text-sm text-gray-500 italic">
                — With all our love
            </p>
        </div>

        <!-- Video Section -->
        <div class="w-full max-w-sm md:max-w-md mx-auto mb-6 md:mb-8">
            @if($video = $wedding->galleries->whereNotNull('video_url')->first())
            @php
            $videoId = null;
            if (preg_match('/youtu\.be\/([^&#]+)/', $video->video_url, $matches)) {
            $videoId = $matches[1];
            } elseif (preg_match('/[\\?&]v=([^&#]+)/', $video->video_url, $matches)) {
            $videoId = $matches[1];
            }
            @endphp

            @if($videoId)
            <div class="relative w-full aspect-video rounded-xl overflow-hidden shadow-xl border-2 border-white/50 bg-gradient-to-br from-white/80 to-white/40 backdrop-blur-sm">
                <iframe
                    class="w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&showinfo=0"
                    title="Prewedding Video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"></iframe>
                <!-- Video overlay decoration -->
                <div class="absolute top-2 left-2 w-3 h-3 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full opacity-80"></div>
                <div class="absolute top-2 right-2 w-2 h-2 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-80"></div>
                <div class="absolute bottom-2 left-2 w-2.5 h-2.5 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full opacity-80"></div>
                <div class="absolute bottom-2 right-2 w-1.5 h-1.5 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-80"></div>
            </div>
            @else
            <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-lg border border-gray-200">
                <div class="text-center text-gray-500">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-2 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-xs md:text-sm italic">Video tidak ditemukan</p>
                </div>
            </div>
            @endif
            @else
            <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center shadow-lg border border-pink-100">
                <div class="text-center text-gray-600">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-2 text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-xs md:text-sm italic">Belum ada video prewedding</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Couple Names -->
        <div class="text-center">
            <p class="text-lg md:text-2xl font-bold text-gray-800 tracking-wide mb-1"
                style="font-family: 'Playfair Display', serif; ">
                {{ $wedding->bride_name }} & {{ $wedding->groom_name }}
            </p>
        </div>
    </div>
</div>
<!-- Thank You Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white"
    style="background-image:
        radial-gradient(circle at 25% 75%, rgba(120,119,198,0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(255,119,198,0.03) 0%, transparent 50%);
        background-color: rgb(251 247 220);">

    <!-- Border Frame -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <div class="flex-1 flex flex-col justify-center px-4 md:px-6 lg:px-8 py-4 md:py-5 lg:py-6">

        <!-- Title -->
        <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
            style="font-family: 'Playfair Display', serif;">
            Thank you
        </h1>
        <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-2 md:mb-3 lg:mb-4"></div>

        <!-- Message -->
        <div class="max-w-sm md:max-w-md lg:max-w-lg mx-auto mb-3 md:mb-4 lg:mb-6">
            <p class="text-xs md:text-sm lg:text-base text-gray-700 leading-relaxed mb-2 md:mb-3 italic"
                style="font-family: 'Playfair Display', serif;">
                "We would like to express our deepest gratitude for your presence and the heartfelt prayers you have given. Your attendance is a true joy and honor for us."
            </p>
            <p class="text-[9px] md:text-xs lg:text-sm text-gray-500 italic">
                — With all our love
            </p>
        </div>

        <!-- Video Section -->
        <div class="w-full max-w-xs md:max-w-sm lg:max-w-md mx-auto mb-3 md:mb-4 lg:mb-6">
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
            <div class="relative w-full aspect-video rounded-xl overflow-hidden shadow-xl border border-white/50 bg-gradient-to-br from-white/80 to-white/40 backdrop-blur-sm">
                <iframe
                    class="w-full h-full rounded-lg"
                    src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&showinfo=0"
                    title="Prewedding Video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"></iframe>
                <!-- Video overlay decoration -->
                <div class="absolute top-1 md:top-2 left-1 md:left-2 w-1.5 md:w-2 lg:w-3 h-1.5 md:h-2 lg:h-3 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full opacity-80"></div>
                <div class="absolute top-1 md:top-2 right-1 md:right-2 w-1 md:w-1.5 lg:w-2 h-1 md:h-1.5 lg:h-2 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-80"></div>
                <div class="absolute bottom-1 md:bottom-2 left-1 md:left-2 w-1.5 md:w-2 lg:w-2.5 h-1.5 md:h-2 lg:h-2.5 bg-gradient-to-br from-pink-400 to-purple-400 rounded-full opacity-80"></div>
                <div class="absolute bottom-1 md:bottom-2 right-1 md:right-2 w-0.5 md:w-1 lg:w-1.5 h-0.5 md:h-1 lg:h-1.5 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-80"></div>
            </div>
            @else
            <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-lg border border-gray-200">
                <div class="text-center text-gray-500">
                    <svg class="w-6 h-6 md:w-8 lg:w-12 h-6 md:h-8 lg:h-12 mx-auto mb-1 md:mb-2 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-[9px] md:text-xs lg:text-sm italic">Video tidak ditemukan</p>
                </div>
            </div>
            @endif
            @else
            <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center shadow-lg border border-pink-100">
                <div class="text-center text-gray-600">
                    <svg class="w-6 h-6 md:w-8 lg:w-12 h-6 md:h-8 lg:h-12 mx-auto mb-1 md:mb-2 text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-[9px] md:text-xs lg:text-sm italic">Belum ada video prewedding</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Couple Names -->
        <div class="text-center">
            <p class="text-sm md:text-lg lg:text-xl font-bold text-gray-800 tracking-wide mb-1"
                style="font-family: 'Playfair Display', serif; ">
                {{ $wedding->bride_name }} & {{ $wedding->groom_name }}
            </p>
        </div>
    </div>
</div>

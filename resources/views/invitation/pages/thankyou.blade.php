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
                — {{ $wedding->bride_name }} & {{ $wedding->groom_name }}
            </p>
        </div>

        <!-- Video Section -->
        <div class="w-full max-w-xs md:max-w-xs lg:max-w-xs mx-auto mb-3 md:mb-4 lg:mb-6">
            @if($video = $wedding->galleries->whereNotNull('video_url')->first())
            @php
            $videoUrl = trim($video->video_url);
            $driveId = null;

            if (preg_match('/drive\.google\.com\/file\/d\/([^\/]+)/', $videoUrl, $matches)) {
            $driveId = $matches[1];
            } elseif (preg_match('/^[a-zA-Z0-9_-]{10,}$/', $videoUrl)) {
            $driveId = $videoUrl;
            }

            $embedUrl = $driveId ? "https://drive.google.com/file/d/{$driveId}/preview" : null;
            @endphp

            @if($embedUrl)
            <div
                class="relative w-full aspect-[9/16] rounded-xl overflow-hidden shadow-xl border border-white/50
                       bg-gradient-to-br from-white/80 to-white/40 backdrop-blur-sm
                       max-h-[50vh] mx-auto">
                <iframe
                    class="w-full h-full rounded-lg"
                    src="{{ $embedUrl }}"
                    title="Wedding Video"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
                </iframe>

            </div>
            @else
            <div class="w-full aspect-video rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-lg border border-gray-200">
                <div class="text-center text-gray-500">
                    <svg class="w-6 h-6 md:w-8 lg:w-12 mx-auto mb-1 md:mb-2 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-[9px] md:text-xs lg:text-sm italic">Video tidak ditemukan</p>
                </div>
            </div>
            @endif
            @else
            <div class="w-full aspect-video rounded-xl  flex items-center justify-center shadow-lg border border-gray-100">
                <div class="text-center text-gray-600">
                    <svg class="w-6 h-6 md:w-8 lg:w-12 mx-auto mb-1 md:mb-2 " fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                    <p class="text-[9px] md:text-xs lg:text-sm italic">Belum ada video prewedding</p>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
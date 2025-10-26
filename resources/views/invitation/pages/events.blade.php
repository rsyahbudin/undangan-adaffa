<!-- Event Details Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white"
    style="background-image:
        radial-gradient(circle at 25% 75%, rgba(120,119,198,0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(255,119,198,0.03) 0%, transparent 50%);
        background-color: rgb(251 247 220);">

    <!-- Border Frame -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8 lg:py-10 relative z-10 flex-1 flex flex-col justify-center">

        <div class="w-full md:max-w-md lg:max-w-lg mx-auto">

            <!-- Title -->
            <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
                style="font-family: 'Playfair Display', serif;">
                Event Details
            </h1>
            <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-3 md:mb-4"></div>

            <!-- <div class="flex-1 overflow-y-auto px-3 md:px-4 lg:px-6 py-2 md:py-3 lg:py-4 space-y-2 md:space-y-3 lg:space-y-4"> -->

            <!-- Wedding Ceremony -->
            <div class="bg-white/90 border border-gray-100 p-3 md:p-3 lg:p-3 rounded-lg shadow-sm hover:shadow-md transition">
                <h3 class="text-sm md:text-sm lg:text-lg text-amber-900 mb-1 font-semibold uppercase tracking-wide"
                    style="font-family: 'Playfair Display', serif;">💍 Wedding Ceremony</h3>
                <p class="text-xs md:text-xs lg:text-sm text-gray-700 leading-relaxed text-center">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($wedding->akad_date)->isoFormat('dddd, MMMM D, YYYY') }}<br>
                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($wedding->akad_start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($wedding->akad_end_time)->format('H:i') }} WIB<br>
                    <strong>Venue:</strong> {{ $wedding->akad_place }}
                </p>
            </div>

            <!-- First Reception -->
            @if($guest->session == 1 && $wedding->reception1_date)
            <div class="bg-white/90 border border-gray-100 p-2 md:p-3 lg:p-3 rounded-lg shadow-sm hover:shadow-md transition mt-3">
                <h3 class="text-sm md:text-sm lg:text-lg text-amber-900 mb-1 font-semibold uppercase tracking-wide"
                    style="font-family: 'Playfair Display', serif;">🎉 Wedding Reception</h3>
                <p class="text-xs md:text-xs lg:text-sm text-gray-700 leading-relaxed text-center">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($wedding->reception1_date)->isoFormat('dddd, MMMM D, YYYY') }}<br>
                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($wedding->reception1_start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($wedding->reception1_end_time)->format('H:i') }} WIB<br>
                    <strong>Venue:</strong> {{ $wedding->reception1_place }}
                </p>
            </div>
            @endif

            <!-- Second Reception -->
            @if($guest->session == 2 && $wedding->reception2_date)
            <div class="bg-white/90 border border-gray-100 p-2 md:p-3 lg:p-3 rounded-lg shadow-sm hover:shadow-md transition mt-3">
                <h3 class="text-sm md:text-sm lg:text-lg text-amber-900 mb-1 font-semibold uppercase tracking-wide"
                    style="font-family: 'Playfair Display', serif;">🎊 Wedding Reception</h3>
                <p class="text-xs md:text-xs lg:text-sm text-gray-700 leading-relaxed text-center">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($wedding->reception2_date)->isoFormat('dddd, MMMM D, YYYY') }}<br>
                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($wedding->reception2_start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($wedding->reception2_end_time)->format('H:i') }} WIB<br>
                    <strong>Venue:</strong> {{ $wedding->reception2_place }}<br>
                    <strong>Dresscode:</strong> Batik
                </p>
            </div>
            @endif

            <!-- Map Section -->
            @if($wedding->maps_url)
            <div class="w-full max-w-xs md:max-w-sm lg:max-w-md mx-auto px-2 md:px-4 mt-3">
                <div class="relative pb-[56.25%] h-0 overflow-hidden rounded-xl md:rounded-2xl shadow-md">
                    <iframe
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2367761350256!2d106.87861207540507!3d-6.363394962251041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed302dffac99%3A0x5865ecdaf645cf7f!2sTeras%20Rumah%20Nenek!5e0!3m2!1sen!2sid!4v1760536461758!5m2!1sen!2sid"
                        style="border:0;"
                        allowfullscreen=""
                        loading="eager"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
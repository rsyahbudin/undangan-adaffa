<!-- Cover Page - Newspaper Style -->
<div class="flipbook-page newspaper-page text-black relative overflow-hidden h-full flex flex-col bg-white">
    <!-- Newspaper Header -->
    <div class="newspaper-cover text-black flex flex-col justify-between h-full px-6 md:px-8 py-6 md:py-8" data-density="hard">
        <!-- Header -->
        <div class="text-center border-b-2 border-black pb-2 mb-2">
            <h1 class="text-xl md:text-4xl lg:text-5xl font-extrabold tracking-widest leading-tight">
                THE WEDDING POST
            </h1>
        </div>

        <!-- Border & Decorative Corners -->
        <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>


        <!-- Date & Location -->
        <div class="flex justify-between text-center border-b-2 border-black pb-2 mb-3 space-y-1 md:space-y-0">
            <p class="text-xs md:text-sm lg:text-base font-semibold uppercase">
                {{ \Carbon\Carbon::parse($wedding->reception1_date)->format('l, d F Y') }}
            </p>
            <p class="text-xs md:text-sm lg:text-base font-semibold uppercase">
                Teras Rumah Nenek
            </p>
        </div>

        <!-- Photo -->
        <div class="flex-1 flex items-center justify-center my-2 md:my-3 min-h-[180px] md:min-h-[250px] lg:min-h-[300px]">
            @if($settings && $settings->cover_photo)
            <img src="{{ Storage::url($settings->cover_photo) }}" alt="Cover Photo"
                class="w-full h-full object-cover border border-black shadow-lg rounded-lg">
            @else
            <div class="w-full h-full bg-gray-300 border border-black flex items-center justify-center rounded-lg">
                <span class="font-bold text-gray-700 text-xs md:text-sm lg:text-base">Foto Cover</span>
            </div>
            @endif
        </div>

        <!-- Footer / Names -->
        <div class="text-center border-t-2 border-black pt-3 mt-2">
            <h2 class="text-lg md:text-3xl lg:text-4xl font-bold tracking-wide leading-snug">
                WE ARE GETTING MARRIED
            </h2>
        </div>
    </div>
</div>
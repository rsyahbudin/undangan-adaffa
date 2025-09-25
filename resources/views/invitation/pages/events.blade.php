<!-- Event Details Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white" style="background-image: 
    radial-gradient(circle at 25% 75%, rgba(120, 119, 198, 0.02) 0%, transparent 50%),
    radial-gradient(circle at 75% 25%, rgba(255, 119, 198, 0.02) 0%, transparent 50%);
    background-color: #fafafa;">
    <div class="absolute top-2 left-2 right-2 bottom-2 border border-amber-300/30 rounded-lg pointer-events-none"></div>
    <div class="absolute top-2 left-2 text-xl text-amber-600/10">💒</div>
    <div class="absolute top-2 right-2 text-xl text-amber-600/10">🎊</div>

    <h2 class="text-lg md:text-xl lg:text-2xl text-amber-800 mb-2 mt-2" style="font-family: 'Dancing Script', cursive;">Detail Acara</h2>

    <div class="flex-1 overflow-y-auto px-3 py-2 space-y-2">
        <!-- Akad Nikah -->
        <div class="bg-white/80 p-2 md:p-3 rounded-lg shadow-sm">
            <h3 class="text-sm md:text-base text-amber-800 mb-1 font-semibold">💍 Akad Nikah</h3>
            <p class="text-xs text-gray-700 mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($wedding->akad_date)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</p>
            <p class="text-xs text-gray-700 mb-1"><strong>Waktu:</strong> {{ $wedding->akad_start_time }} - {{ $wedding->akad_end_time }} WIB</p>
            <p class="text-xs text-gray-700"><strong>Tempat:</strong> {{ $wedding->akad_place }}</p>
        </div>

        @if($guest->session == 1 && $wedding->reception1_date)
        <!-- Resepsi 1 -->
        <div class="bg-white/80 p-2 md:p-3 rounded-lg shadow-sm">
            <h3 class="text-sm md:text-base text-amber-800 mb-1 font-semibold">🎉 Resepsi Pernikahan</h3>
            <p class="text-xs text-gray-700 mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($wedding->reception1_date)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</p>
            <p class="text-xs text-gray-700 mb-1"><strong>Waktu:</strong> {{ $wedding->reception1_start_time }} - {{ $wedding->reception1_end_time }} WIB</p>
            <p class="text-xs text-gray-700"><strong>Tempat:</strong> {{ $wedding->reception1_place }}</p>
        </div>
        @endif

        @if($guest->session == 2 && $wedding->reception2_date)
        <!-- Resepsi 2 -->
        <div class="bg-white/80 p-2 md:p-3 rounded-lg shadow-sm">
            <h3 class="text-sm md:text-base text-amber-800 mb-1 font-semibold">🎊 Resepsi Kedua</h3>
            <p class="text-xs text-gray-700 mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($wedding->reception2_date)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</p>
            <p class="text-xs text-gray-700 mb-1"><strong>Waktu:</strong> {{ $wedding->reception2_start_time }} - {{ $wedding->reception2_end_time }} WIB</p>
            <p class="text-xs text-gray-700"><strong>Tempat:</strong> {{ $wedding->reception2_place }}</p>
        </div>
        @endif

        <!-- Maps -->
        @if($wedding->maps_url)
        <div class="bg-white/80 p-2 md:p-3 rounded-lg shadow-sm">
            <h3 class="text-sm md:text-base text-amber-800 mb-2 font-semibold">📍 Lokasi</h3>
            <a href="{{ $wedding->maps_url }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors duration-300">
                Buka di Google Maps
            </a>
        </div>
        @endif
    </div>
</div>


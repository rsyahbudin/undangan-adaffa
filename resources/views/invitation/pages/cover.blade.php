<!-- Cover Page - Newspaper Style -->
<div class="flipbook-page newspaper-page text-black relative overflow-hidden h-full flex flex-col">
    <!-- Newspaper Header -->
    <div class="newspaper-cover text-black flex flex-col justify-between px-6 py-6" data-density="hard">
    <!-- Header -->
    <div class="text-center border-b-2 border-black pb-2">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-widest">SAVE THE DATE</h1>
        <p class="text-sm md:text-base font-semibold mt-1">
            {{ \Carbon\Carbon::parse($wedding->reception1_date)->format('l, d F Y') }}
        </p>
    </div>

    <!-- Photo -->
    <div class="flex-1 flex items-center justify-center my-4">
        @if($settings && $settings->cover_photo)
            <img src="{{ Storage::url($settings->cover_photo) }}" alt="Cover Photo"
                 class="w-full h-64 object-cover border-4 border-black shadow-md">
        @else
            <div class="w-full h-64 bg-gray-300 border-4 border-black flex items-center justify-center">
                <span class="font-bold text-gray-700">Foto Cover</span>
            </div>
        @endif
    </div>

    <!-- Names -->
    <div class="text-center border-t-2 border-black pt-2">
        <h2 class="text-xl md:text-2xl font-bold tracking-wide">
            {{ strtoupper($wedding->bride_nickname) }} & {{ strtoupper($wedding->groom_nickname) }}
        </h2>
        <p class="italic text-sm md:text-base mt-1">Are Getting Married</p>
    </div>
</div>

</div>
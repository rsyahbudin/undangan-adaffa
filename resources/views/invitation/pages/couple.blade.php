<!-- Couple Introduction Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white" style="background-image: 
    radial-gradient(circle at 30% 70%, rgba(120, 119, 198, 0.02) 0%, transparent 50%),
    radial-gradient(circle at 70% 30%, rgba(255, 119, 198, 0.02) 0%, transparent 50%);
    background-color: #fafafa;">
    <div class="absolute top-2 left-2 right-2 bottom-2 border border-amber-300/30 rounded-lg pointer-events-none"></div>
    <div class="absolute top-2 left-2 text-xl text-amber-600/10">🌼</div>
    <div class="absolute top-2 right-2 text-xl text-amber-600/10">🌿</div>

    <h2 class="text-lg md:text-xl lg:text-2xl text-amber-800 mb-3 mt-2" style="font-family: 'Dancing Script', cursive;">Mempelai</h2>
    <div class="flex flex-col md:flex-row justify-center items-center flex-1 gap-2 md:gap-3 px-4">
        <div class="text-center flex-1">
            @if($wedding->bride_photo)
            <img src="{{ Storage::url($wedding->bride_photo) }}" alt="{{ $wedding->bride_name }}" class="w-20 h-24 md:w-24 md:h-28 lg:w-28 lg:h-32 object-cover rounded-full border-2 border-white shadow-lg mx-auto">
            @else
            <img src="{{ asset('images/bride.jpg') }}" alt="{{ $wedding->bride_name }}" class="w-20 h-24 md:w-24 md:h-28 lg:w-28 lg:h-32 object-cover rounded-full border-2 border-white shadow-lg mx-auto">
            @endif
            <div class="text-sm md:text-base lg:text-lg text-amber-800 mt-2 font-semibold" style="font-family: 'Playfair Display', serif;">{{ $wedding->bride_name }}</div>
            <div class="text-xs text-gray-600 mt-1">Putri dari<br>{{ $wedding->bride_father_name }} & {{ $wedding->bride_mother_name }}</div>
        </div>
        <div class="text-center flex-1">
            @if($wedding->groom_photo)
            <img src="{{ Storage::url($wedding->groom_photo) }}" alt="{{ $wedding->groom_name }}" class="w-20 h-24 md:w-24 md:h-28 lg:w-28 lg:h-32 object-cover rounded-full border-2 border-white shadow-lg mx-auto">
            @else
            <img src="{{ asset('images/groom.jpg') }}" alt="{{ $wedding->groom_name }}" class="w-20 h-24 md:w-24 md:h-28 lg:w-28 lg:h-32 object-cover rounded-full border-2 border-white shadow-lg mx-auto">
            @endif
            <div class="text-sm md:text-base lg:text-lg text-amber-800 mt-2 font-semibold" style="font-family: 'Playfair Display', serif;">{{ $wedding->groom_name }}</div>
            <div class="text-xs text-gray-600 mt-1">Putra dari<br>{{ $wedding->groom_father_name }} & {{ $wedding->groom_mother_name }}</div>
        </div>
    </div>
</div>


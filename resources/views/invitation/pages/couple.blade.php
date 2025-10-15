<!-- Couple Introduction Page -->
<div class="flipbook-page text-center relative overflow-hidden flex flex-col justify-between bg-[#fafafa]"
    style="background-image: 
        radial-gradient(circle at 30% 70%, rgba(120,119,198,0.03) 0%, transparent 60%),
        radial-gradient(circle at 70% 30%, rgba(255,119,198,0.03) 0%, transparent 60%);">

    <!-- Border -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <div class="md:px-8 md:py-10 relative z-10">

        <!-- Title -->
        <h1 class="text-2xl md:text-4xl font-extrabold tracking-wide uppercase mb-4"
            style="font-family: 'Playfair Display', serif;">
            The Couple
        </h1>

        <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>

        <!-- Couple Section -->
<div class="w-full flex justify-center px-4 md:px-12">
    <table class="w-full max-w-4xl text-center align-middle">
        <tr class="align-middle">
            <!-- Bride -->
            <td class="w-1/3 align-top">
                <div class="flex flex-col items-center">
                    <div
                        class="relative w-28 h-32 md:w-48 md:h-52 rounded-full overflow-hidden border-[2.5px] shadow-md bg-white">
                        <img src="{{ $wedding->bride_photo ? Storage::url($wedding->bride_photo) : asset('images/bride.jpg') }}"
                            alt="{{ $wedding->bride_name }}" class="w-full h-full object-cover object-center">
                    </div>
                    <h3 class="text-sm md:text-xl mt-2 font-semibold text-center break-words max-w-[160px] md:max-w-none"
                        style="font-family: 'Playfair Display', serif;">
                        {{ $wedding->bride_name }}
                    </h3>
                    <p class="italic text-gray-500 text-[10px] md:text-base py-2">{{ $wedding->bride_nickname }}</p>
                    <p class="text-gray-700 text-[10px] md:text-base leading-tight">
                        Daughter of<br>
                        <span class="font-medium">Mr. {{ $wedding->bride_father_name }}</span> &
                        <span class="font-medium">Mrs. {{ $wedding->bride_mother_name }}</span>
                    </p>
                </div>
            </td>

            <!-- Groom -->
            <td class="w-1/3 align-top">
                <div class="flex flex-col items-center">
                    <div
                        class="relative w-28 h-32 md:w-48 md:h-52 rounded-full overflow-hidden border-[2.5px] shadow-md bg-white">
                        <img src="{{ $wedding->groom_photo ? Storage::url($wedding->groom_photo) : asset('images/groom.jpg') }}"
                            alt="{{ $wedding->groom_name }}" class="w-full h-full object-cover object-center">
                    </div>
                    <h3 class="text-sm md:text-xl mt-2 font-semibold text-center break-words max-w-[240px] md:max-w-none"
                        style="font-family: 'Playfair Display', serif;">
                        {{ $wedding->groom_name }}
                    </h3>
                    <p class="italic text-gray-500 text-[10px] md:text-base py-2">{{ $wedding->groom_nickname }}</p>
                    <p class="text-gray-700 text-[10px] md:text-base leading-tight">
                        Son of<br>
                        <span class="font-medium">Mr. {{ $wedding->groom_father_name }}</span> &
                        <span class="font-medium">Mrs. {{ $wedding->groom_mother_name }}</span>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</div>



        <!-- Relationship Duration -->
        @php
        $startDate = new DateTime('2019-09-10');
        $today = new DateTime();
        $interval = $startDate->diff($today);
        $years = str_pad($interval->y, 2, '0', STR_PAD_LEFT);
        $months = str_pad($interval->m, 2, '0', STR_PAD_LEFT);
        $days = str_pad($interval->d, 2, '0', STR_PAD_LEFT);
        @endphp

        <div class=" px-4 mt-2 md:mt-8">
            <h2 class="text-lg md:text-2xl mb-2" style="font-family: 'Playfair Display', serif;">
                Together Since
            </h2>


            <div class="flex justify-center gap-2 md:gap-8 font-mono text-gray-900 md:mb-4 md:mt-4">
                <div class="text-center">
                    <div class="text-xl md:text-4xl font-bold">{{ $years }}</div>
                    <div class="text-xs md:text-lg uppercase tracking-wide">Years</div>
                </div>
                <div class="text-center">
                    <div class="text-xl md:text-4xl font-bold">{{ $months }}</div>
                    <div class="text-xs md:text-lg uppercase tracking-wide">Months</div>
                </div>
                <div class="text-center">
                    <div class="text-xl md:text-4xl font-bold">{{ $days }}</div>
                    <div class="text-xs md:text-lg uppercase tracking-wide">Days</div>
                </div>
            </div>

        </div>
        <!-- Quran Verse -->
        <div class="max-w-2xl md:max-w-2xl mx-auto text-xs md:text-lg text-gray-600 leading-relaxed italic md:px-2  mt-2">
            “And of His signs is that He created for you mates from among yourselves, that you may find tranquillity
            in them, and He placed between you affection and mercy. Surely in this are signs for people who reflect.”
            <br><span class="text-xs md:text-base text-amber-700">— Qur’an, Ar-Rum: 21</span>
        </div>
    </div>
</div>
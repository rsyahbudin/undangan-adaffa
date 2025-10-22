<!-- Couple Introduction Page -->
<div class="flipbook-page text-center relative overflow-hidden flex flex-col justify-between bg-white"
    style="background-image:
        radial-gradient(circle at 30% 70%, rgba(120,119,198,0.03) 0%, transparent 60%),
        radial-gradient(circle at 70% 30%, rgba(255,119,198,0.03) 0%, transparent 60%);
        background-color: rgb(251 247 220);">

    <!-- Border -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8 lg:py-10 relative z-10">

        <!-- Title -->
        <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
            style="font-family: 'Playfair Display', serif;">
            The Couple
        </h1>

        <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-3 md:mb-4"></div>

        <!-- Couple Section -->
        <div class="w-full flex justify-center px-2 md:px-4 lg:px-6">
            <table class="w-full max-w-2xl md:max-w-3xl lg:max-w-4xl text-center align-middle">
                <tr class="align-middle">
                    <!-- Bride -->
                    <td class="w-1/2 align-top px-1 md:px-2 lg:px-4">
                        <div class="flex flex-col items-center">
                            <div
                                class="relative w-28 h-32 md:w-28 md:h-32 lg:w-36 lg:h-40 rounded-full overflow-hidden border-2 shadow-lg bg-white">
                                <img src="{{ $wedding->bride_photo ? Storage::url($wedding->bride_photo) : asset('images/bride.jpg') }}"
                                    alt="{{ $wedding->bride_name }}" class="w-full h-full object-cover object-center">
                            </div>
                            <h3 class="text-base md:text-base lg:text-lg mt-1 md:mt-2 font-semibold text-center break-words max-w-[100px] md:max-w-[140px] lg:max-w-none"
                                style="font-family: 'Playfair Display', serif;">
                                {{ $wedding->bride_name }}
                            </h3>
                            <p class="italic text-gray-500 text-xs md:text-xs lg:text-sm py-1">{{ $wedding->bride_nickname }}</p>
                            <p class="text-gray-700 text-xs md:text-xs lg:text-sm leading-tight">
                                Daughter of<br>
                                <span class="font-medium">Mr. {{ $wedding->bride_father_name }}</span> &
                                <span class="font-medium">Mrs. {{ $wedding->bride_mother_name }}</span>
                            </p>
                        </div>
                    </td>

                    <!-- Groom -->
                    <td class="w-1/2 align-top px-1 md:px-2 lg:px-4">
                        <div class="flex flex-col items-center">
                            <div
                                class="relative w-28 h-32 md:w-28 md:h-32 lg:w-36 lg:h-40 rounded-full overflow-hidden border-2 shadow-lg bg-white">
                                <img src="{{ $wedding->groom_photo ? Storage::url($wedding->groom_photo) : asset('images/groom.jpg') }}"
                                    alt="{{ $wedding->groom_name }}" class="w-full h-full object-cover object-center">
                            </div>
                            <h3 class="text-base md:text-base lg:text-lg mt-1 md:mt-2 font-semibold text-center break-words max-w-[100px] md:max-w-[140px] lg:max-w-none"
                                style="font-family: 'Playfair Display', serif;">
                                {{ $wedding->groom_name }}
                            </h3>
                            <p class="italic text-gray-500 text-xs md:text-xs lg:text-sm py-1">{{ $wedding->groom_nickname }}</p>
                            <p class="text-gray-700 text-xs md:text-xs lg:text-sm leading-tight">
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

        <div class="px-4 mt-3 md:mt-6 lg:mt-8">
            <h2 class="text-base md:text-xl lg:text-2xl mb-2" style="font-family: 'Playfair Display', serif;">
                Together Since
            </h2>

            <div class="flex justify-center gap-2 md:gap-4 lg:gap-8 font-mono text-gray-900 mb-3 md:mb-4 mt-2 md:mt-4">
                <div class="text-center">
                    <div class="text-lg md:text-3xl lg:text-4xl font-bold">{{ $years }}</div>
                    <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Years</div>
                </div>
                <div class="text-center">
                    <div class="text-lg md:text-3xl lg:text-4xl font-bold">{{ $months }}</div>
                    <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Months</div>
                </div>
                <div class="text-center">
                    <div class="text-lg md:text-3xl lg:text-4xl font-bold">{{ $days }}</div>
                    <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Days</div>
                </div>
            </div>

        </div>
        <!-- Quran Verse -->
        <div class="max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto text-xs md:text-sm lg:text-base text-gray-600 leading-relaxed italic px-2 md:px-4 mt-2 md:mt-3">
            "And of His signs is that He created for you mates from among yourselves, that you may find tranquillity
            in them, and He placed between you affection and mercy. Surely in this are signs for people who reflect."
            <br><span class="text-xs md:text-sm lg:text-base text-amber-700 mt-1 block">— Qur'an, Ar-Rum: 21</span>
        </div>
    </div>
</div>

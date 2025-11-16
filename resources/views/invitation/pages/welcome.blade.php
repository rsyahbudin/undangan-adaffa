<!-- Welcome Page - Countdown Style -->
<div class="flipbook-page newspaper-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-white"
    style="background-image:
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.03) 0%, transparent 50%);
        background-color: rgb(251 247 220);">

    <!-- Border & Decorative Corners -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Content -->
    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8 lg:py-10 relative z-10">
        <!-- Headline -->
        <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
            style="font-family: 'Playfair Display', serif;">
            The Wedding Countdown
        </h1>

        <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-3 md:mb-4"></div>

        <!-- Gallery Photo (1 image only) -->
        @php
        $photo = $galleries->first();
        @endphp

        @if($photo && $photo['file_path'])
        <div class="w-full h-full flex justify-center mb-3 md:mb-4 lg:mb-6">
            <img src="{{ Storage::url($photo['file_path']) }}"
                alt="Wedding Gallery Photo"
                class="w-full max-w-xs md:max-w-sm lg:max-w-md h-65 md:h-65 lg:h-80 object-cover border border-black/10 shadow-lg rounded-lg">
        </div>
        @endif

        <!-- Guest Name -->
        <!-- <h2 class="text-2xl text-gray-900 font-semibold mb-2"
            style="font-family: 'Dancing Script', cursive;">
            Welcome, Guest
        </h2> -->

        <p class="text-base md:text-base lg:text-base text-gray-600 mb-3 md:mb-4">
            We are delighted to invite you to celebrate the sacred union of our beloved couple.
        </p>

        <!-- Countdown -->
        <div id="countdown" class="flex justify-center gap-2 md:gap-4 lg:gap-6 font-mono text-gray-900 mb-2">
            <div class="text-center">
                <div id="days" class="text-xl md:text-3xl lg:text-4xl font-bold">00</div>
                <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Days</div>
            </div>
            <div class="text-center">
                <div id="hours" class="text-xl md:text-3xl lg:text-4xl font-bold">00</div>
                <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Hours</div>
            </div>
            <div class="text-center">
                <div id="minutes" class="text-xl md:text-3xl lg:text-4xl font-bold">00</div>
                <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Minutes</div>
            </div>
            <div class="text-center">
                <div id="seconds" class="text-xl md:text-3xl lg:text-4xl font-bold">00</div>
                <div class="text-xs md:text-sm lg:text-base uppercase tracking-wide">Seconds</div>
            </div>
        </div>

    </div>
</div>

<!-- Countdown Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get akad date & time from Blade
        const akadDate = "{{ $wedding->akad_date }}";
        const akadTime = "{{ $wedding->akad_start_time }}";

        // Combine into one datetime string
        const targetDate = new Date(`${akadDate}T${akadTime}`);

        function updateCountdown() {
            const now = new Date();
            const diff = targetDate - now;

            if (diff <= 0) {
                document.getElementById('countdown').innerHTML =
                    "<p class='text-lg font-semibold text-gray-700'>The Akad Ceremony Has Begun 🎉</p>";
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((diff / (1000 * 60)) % 60);
            const seconds = Math.floor((diff / 1000) % 60);

            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>
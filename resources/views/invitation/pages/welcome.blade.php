<!-- Welcome Page - Countdown Style -->
<div class="flipbook-page newspaper-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.03) 0%, transparent 50%);
        background-color: #fafafa;">

    <!-- Border & Decorative Corners -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-black/20 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Content -->
    <div class="md:px-8 md:py-10 relative z-10">
        <!-- Headline -->
        <h1 class="text-xl md:text-4xl font-extrabold tracking-wide uppercase mb-4"
            style="font-family: 'Playfair Display', serif;">
            The Wedding Countdown
        </h1>

        <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>

        <!-- Gallery Photo (1 image only) -->
        @php
        $photo = $galleries->first();
        @endphp

        @if($photo && $photo['file_path'])
        <div class="w-full flex justify-center mb-6">
            <img src="{{ Storage::url($photo['file_path']) }}"
                alt="Wedding Gallery Photo"
                class="w-full h-64 md:w-74 md:h-full object-cover border border-black/10 shadow-md rounded-md">
        </div>
        @endif

        <!-- Subheadline -->
        <!-- <p class="text-sm md:text-xl text-gray-700 italic mb-6">
            “Love doesn’t make the world go round, love is what makes the ride worthwhile.”
        </p> -->

        <!-- Guest Name -->
        <h2 class="text-xl md:text-2xl text-gray-900 font-semibold mb-2"
            style="font-family: 'Dancing Script', cursive;">
            Welcome, {{ $guest->name }}
        </h2>

        <p class="text-xs md:text-xl text-gray-600 mb-2">
            We are delighted to invite you to celebrate the sacred union of our beloved couple.
        </p>

        <!-- Countdown -->
        <div id="countdown" class="flex justify-center gap-3 md:gap-6 font-mono text-gray-900 mb-2">
            <div class="text-center">
                <div id="days" class="text-2xl md:text-4xl font-bold">00</div>
                <div class="text-xs md:text-xl uppercase tracking-wide">Days</div>
            </div>
            <div class="text-center">
                <div id="hours" class="text-2xl md:text-4xl font-bold">00</div>
                <div class="text-xs md:text-xl uppercase tracking-wide">Hours</div>
            </div>
            <div class="text-center">
                <div id="minutes" class="text-2xl md:text-4xl font-bold">00</div>
                <div class="text-xs md:text-xl uppercase tracking-wide">Minutes</div>
            </div>
            <div class="text-center">
                <div id="seconds" class="text-2xl md:text-4xl font-bold">00</div>
                <div class="text-xs md:text-xl uppercase tracking-wide">Seconds</div>
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
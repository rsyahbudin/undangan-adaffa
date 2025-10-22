<!-- Digital Envelope Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-white"
    class="bg-gradient-to-br from-amber-50 to-yellow-50">

    <!-- Border -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-amber-300/40 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Content -->
    <div class="px-4 md:px-6 lg:px-8 py-6 md:py-8 lg:py-10 relative z-10">

        <!-- Title -->
        <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4"
                style="font-family: 'Playfair Display', serif;">
                Digital Envelope
            </h1>
        <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-2 md:mb-3 lg:mb-4"></div>

        <!-- Description -->
        <p class="text-sm md:text-sm lg:text-base text-gray-600 max-w-xs md:max-w-sm lg:max-w-md leading-snug md:leading-relaxed px-1 text-center mx-auto mb-5">
            If giving is a reflection of your love, you may share your gift in a cashless way through the accounts below.
        </p>

        <!-- Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3 lg:gap-4 w-full max-w-xs md:max-w-xl lg:max-w-2xl mx-auto mb-4 md:mb-5 lg:mb-6">
            <!-- BCA Card -->
            <div
                class="relative bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl p-2 md:p-3 lg:p-4 shadow-md flex flex-col justify-between min-h-[100px] md:min-h-[100px] lg:min-h-[120px]">
                <div class="flex justify-between items-center mb-1">
                    <h2 class="text-base md:text-base lg:text-lg font-bold">BCA Bank</h2>
                </div>
                <div class="text-left leading-tight">
                    <p class="text-sm md:text-sm lg:text-sm opacity-80">Account Number</p>
                    <p id="bcaNumber" class="text-base md:text-base lg:text-xl font-semibold tracking-widest">5379413117718038</p>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-sm md:text-sm lg:text-sm">Nadia Ariandyen</p>
                    <button onclick="copyToClipboard('bcaNumber')"
                        class="px-1 py-0.5 text-sm md:text-sm lg:text-sm bg-white/20 hover:bg-white/30 rounded-lg transition-all">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Mandiri Card -->
            <div
                class="relative bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 text-gray-900 rounded-xl p-2 md:p-3 lg:p-4 shadow-md flex flex-col justify-between min-h-[100px] md:min-h-[100px] lg:min-h-[120px]">
                <div class="flex justify-between items-center mb-1">
                    <h2 class="text-base md:text-base lg:text-lg font-bold">Mandiri Bank</h2>
                </div>
                <div class="text-left leading-tight">
                    <p class="text-sm md:text-sm lg:text-sm opacity-80">Account Number</p>
                    <p id="mandiriNumber" class="text-base md:text-sm lg:text-xl font-semibold tracking-widest">1290013566860</p>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-sm md:text-sm lg:text-sm">Muhammad Daffa Syahbudin</p>
                    <button onclick="copyToClipboard('mandiriNumber')"
                        class="px-1 py-0.5 text-sm md:text-sm lg:text-sm bg-black/10 hover:bg-black/20 rounded-lg transition-all">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Physical Address Card -->
            <div
                class="relative bg-gradient-to-br from-gray-100 to-gray-200 text-gray-900 rounded-xl p-2 md:p-3 lg:p-4 shadow-md flex flex-col justify-center items-center text-center min-h-[90px] md:min-h-[100px] lg:min-h-[120px] md:col-span-2">
                <div class="mb-1">
                    <h2 class="text-base md:text-base lg:text-lg font-bold">Physical Address</h2>
                </div>
                <div class="leading-tight">
                    <p class="text-sm md:text-sm lg:text-base font-semibold">Daffa Syahbudin</p>
                    <p class="text-sm md:text-sm lg:text-base text-gray-700 mt-0.5">Jl. Abdulrahman No 12 RT 16/05 Cibubur (Rumah Syahbudin)</p>
                    <p class="text-sm md:text-sm lg:text-base text-gray-700 mt-0.5">+62 878-7850-3378</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copy Script -->
<script>
    function copyToClipboard(id) {
        const text = document.getElementById(id).textContent.trim();
        navigator.clipboard.writeText(text).then(() => {
            alert('Account number copied: ' + text);
        });
    }
</script>
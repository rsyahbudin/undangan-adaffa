<!-- Digital Envelope Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 20% 80%, rgba(218,165,32,0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,215,0,0.06) 0%, transparent 50%);
        background-color: #fafafa;">

    <!-- Border -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-amber-300/40 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Content -->
    <div class="flex-1 overflow-y-auto px-3 md:px-6 md:py-4 space-y-3 md:space-y-6">

        <!-- Title -->
        <h2 class="text-2xl md:text-4xl font-extrabold tracking-wide uppercase mt-4 mb-1 md:mb-4"
            style="font-family: 'Playfair Display', serif;">
            Digital Envelope
        </h2>
        <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>

        <!-- Description -->
        <p class="text-[12px] md:text-lg text-gray-600 max-w-xs md:max-w-md leading-snug md:leading-relaxed px-1 text-center mx-auto">
            If giving is a reflection of your love, you may share your gift in a cashless way through the accounts below.
        </p>

        <!-- Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6 w-full max-w-xs md:max-w-2xl mx-auto md:mb-8">
            <!-- BCA Card -->
            <div
                class="relative bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl p-2 md:p-5 shadow-md flex flex-col justify-between h-28 md:h-54">
                <div class="flex justify-between items-center mb-1 md:mb-2">
                    <h2 class="text-xs md:text-xl font-bold">BCA Bank</h2>
                </div>
                <div class="text-left leading-tight">
                    <p class="text-xs md:text-base opacity-80">Account Number</p>
                    <p id="bcaNumber" class="text-base md:text-2xl font-semibold tracking-widest">5379413117718038</p>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs md:text-base">Nadia Ariandyen</p>
                    <button onclick="copyToClipboard('bcaNumber')"
                        class="px-1 py-0.5 text-xs md:text-sm bg-white/20 hover:bg-white/30 rounded-lg transition-all">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Mandiri Card -->
            <div
                class="relative bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 text-gray-900 rounded-xl p-2 md:p-5 shadow-md flex flex-col justify-between h-28 md:h-54">
                <div class="flex justify-between items-center mb-1 md:mb-2">
                    <h2 class="text-xs md:text-xl font-bold">Mandiri Bank</h2>
                </div>
                <div class="text-left leading-tight">
                    <p class="text-xs md:text-base opacity-80">Account Number</p>
                    <p id="mandiriNumber" class="text-base md:text-2xl font-semibold tracking-widest">1290013566860</p>
                </div>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-xs md:text-base">Muhammad Daffa Syahbudin</p>
                    <button onclick="copyToClipboard('mandiriNumber')"
                        class="px-1 py-0.5 text-xs md:text-sm bg-black/10 hover:bg-black/20 rounded-lg transition-all">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Physical Address Card -->
            <div
                class="relative bg-gradient-to-br from-gray-100 to-gray-200  text-gray-900 rounded-xl p-2 md:p-5 shadow-md flex flex-col justify-between md:justify-center items-center text-center h-28 md:h-54 md:col-span-2">
                <div class="mb-1 md:mb-2">
                    <h2 class="text-xs md:text-xl font-bold">Physical Address</h2>
                </div>
                <div class="leading-tight">
                    <p class="text-xs md:text-lg font-semibold">Daffa Syahbudin</p>
                    <p class="text-[12px] md:text-base text-gray-700 mt-0.5">Jl. Abdulrahman No 12 RT 16/05 Cibubur (Rumah Syahbudin)</p>
                    <p class="text-xs md:text-base text-gray-700 mt-0.5">+62 878-7850-3378</p>
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

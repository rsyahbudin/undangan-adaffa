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
        <div class="flex flex-col gap-4 md:grid md:grid-cols-2 md:gap-6 lg:gap-8 w-full max-w-sm md:max-w-2xl lg:max-w-3xl mx-auto mb-4 md:mb-5 lg:mb-6">
            <!-- BCA Card -->
            <div
                class="relative bg-white border-2 border-blue-200 text-gray-900 rounded-2xl p-2 md:p-4 lg:p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col justify-between min-h-[100px] md:min-h-[130px] lg:min-h-[150px]">
                <div class="flex justify-between items-center mb-1.5 md:mb-2 lg:mb-3">
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <div class="w-2.5 h-2.5 md:w-3 md:h-3 bg-blue-500 rounded-full"></div>
                        <h2 class="text-sm md:text-lg lg:text-xl font-bold">BCA</h2>
                    </div>
                </div>
                <div class="text-left leading-tight flex-1">
                    <p class="text-xs md:text-sm lg:text-base text-gray-600 mb-0.5 md:mb-1">Account Number</p>
                    <p id="bcaNumber" class="text-sm md:text-lg lg:text-xl font-bold tracking-widest text-gray-900">5379413117718038</p>
                </div>
                <div class="flex justify-between items-center mt-2 md:mt-3">
                    <p class="text-xs md:text-sm lg:text-base font-medium text-gray-700">Nadia Ariandyen</p>
                    <button onclick="copyToClipboard('bcaNumber')"
                        class="px-2 py-1 md:px-3 md:py-1.5 text-xs md:text-sm lg:text-base bg-blue-500 hover:bg-blue-600 text-white rounded-md md:rounded-lg transition-all font-medium">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Mandiri Card -->
            <div
                class="relative bg-white border-2 border-yellow-200 text-gray-900 rounded-2xl p-2 md:p-4 lg:p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col justify-between min-h-[100px] md:min-h-[130px] lg:min-h-[150px]">
                <div class="flex justify-between items-center mb-1.5 md:mb-2 lg:mb-3">
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <div class="w-2.5 h-2.5 md:w-3 md:h-3 bg-yellow-500 rounded-full"></div>
                        <h2 class="text-sm md:text-lg lg:text-xl font-bold">Mandiri</h2>
                    </div>
                </div>
                <div class="text-left leading-tight flex-1">
                    <p class="text-xs md:text-sm lg:text-base text-gray-600 mb-0.5 md:mb-1">Account Number</p>
                    <p id="mandiriNumber" class="text-sm md:text-lg lg:text-xl font-bold tracking-widest text-gray-900">1290013566860</p>
                </div>
                <div class="flex justify-between items-center mt-2 md:mt-3">
                    <p class="text-xs md:text-sm lg:text-base font-medium text-gray-700">Muhammad Daffa Syahbudin</p>
                    <button onclick="copyToClipboard('mandiriNumber')"
                        class="px-2 py-1 md:px-3 md:py-1.5 text-xs md:text-sm lg:text-base bg-yellow-500 hover:bg-yellow-600 text-white rounded-md md:rounded-lg transition-all font-medium">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Physical Address Card -->
            <div
                class="relative bg-white border-2 border-gray-200 text-gray-900 rounded-2xl p-2 md:p-4 lg:p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex flex-col justify-center items-center text-center min-h-[100px] md:min-h-[130px] lg:min-h-[150px] md:col-span-2">
                <div class="mb-1 md:mb-2">
                    <div class="flex items-center justify-center gap-1.5 md:gap-2 mb-1.5 md:mb-2">
                        <div class="w-2.5 h-2.5 md:w-3 md:h-3 bg-gray-500 rounded-full"></div>
                        <h2 class="text-sm md:text-lg lg:text-xl font-bold">Address</h2>
                    </div>
                </div>
                <div class="leading-tight text-center">
                    <p class="text-sm md:text-lg lg:text-xl font-bold text-gray-900 mb-0.5 md:mb-1">Daffa Syahbudin</p>
                    <p class="text-xs md:text-sm lg:text-base text-gray-700">Jl. Abdulrahman No 12 RT 16/05</p>
                    <p class="text-xs md:text-sm lg:text-base text-gray-700">Cibubur (Rumah Syahbudin)</p>
                    <p class="text-xs md:text-sm lg:text-base text-gray-700 font-medium mt-0.5 md:mt-1">+62 878-7850-3378</p>
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
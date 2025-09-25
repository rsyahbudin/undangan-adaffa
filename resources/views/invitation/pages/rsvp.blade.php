<!-- RSVP Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col bg-white" style="background-image: 
    radial-gradient(circle at 35% 65%, rgba(120, 119, 198, 0.02) 0%, transparent 50%),
    radial-gradient(circle at 65% 35%, rgba(255, 119, 198, 0.02) 0%, transparent 50%);
    background-color: #fafafa;">
    <div class="absolute top-2 left-2 right-2 bottom-2 border border-amber-300/30 rounded-lg pointer-events-none"></div>
    <div class="absolute top-2 left-2 text-xl text-amber-600/10">📝</div>
    <div class="absolute top-2 right-2 text-xl text-amber-600/10">💌</div>

    <h2 class="text-lg md:text-xl lg:text-2xl text-amber-800 mb-2 mt-2" style="font-family: 'Dancing Script', cursive;">Konfirmasi Kehadiran</h2>

    <div class="px-3 py-2 flex-1 overflow-y-auto">
        <p class="text-xs md:text-sm text-gray-600 mb-3 leading-tight">
            Mohon konfirmasi kehadiran Anda untuk memudahkan kami dalam mempersiapkan acara
        </p>

        <form id="rsvp-form" class="max-w-sm mx-auto" style="pointer-events: auto;">
            <div class="bg-white/90 p-3 rounded-lg shadow-lg" style="pointer-events: auto;">
                <div class="mb-3">
                    <label class="block text-xs text-gray-700 mb-1 font-semibold">Nama Lengkap</label>
                    <input type="text" id="guest-name" value="{{ $guest->name }}" readonly class="w-full px-2 py-1 border border-gray-300 rounded bg-gray-100 text-gray-600 text-xs">
                </div>

                <div class="mb-3" style="pointer-events: auto;">
                    <label class="block text-xs text-gray-700 mb-1 font-semibold">Status Kehadiran</label>
                    <div class="space-y-1">
                        <label class="flex items-center cursor-pointer" style="pointer-events: auto;">
                            <input type="radio" name="attendance" value="1" class="mr-1 cursor-pointer" style="pointer-events: auto;" required>
                            <span class="text-xs text-green-600 font-semibold cursor-pointer">✅ Akan Hadir</span>
                        </label>
                        <label class="flex items-center cursor-pointer" style="pointer-events: auto;">
                            <input type="radio" name="attendance" value="0" class="mr-1 cursor-pointer" style="pointer-events: auto;" required>
                            <span class="text-xs text-red-600 font-semibold cursor-pointer">❌ Tidak Bisa Hadir</span>
                        </label>
                    </div>
                </div>

                <div class="mb-3" style="pointer-events: auto;">
                    <label class="block text-xs text-gray-700 mb-1 font-semibold">Jumlah Tamu</label>
                    <select id="guest-count" class="w-full px-2 py-1 border border-gray-300 rounded text-xs cursor-pointer" style="pointer-events: auto;" required>
                        <option value="">Pilih jumlah tamu</option>
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3">3 Orang</option>
                        <option value="4">4 Orang</option>
                        <option value="5">5 Orang</option>
                    </select>
                </div>

                <div class="mb-3" style="pointer-events: auto;">
                    <label class="block text-xs text-gray-700 mb-1 font-semibold">Pesan (Opsional)</label>
                    <textarea id="message" rows="2" class="w-full px-2 py-1 border border-gray-300 rounded text-xs cursor-text" style="pointer-events: auto;" placeholder="Tuliskan pesan atau doa untuk mempelai..."></textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-2 px-3 rounded text-xs transition-all duration-300 cursor-pointer" style="pointer-events: auto;">
                    Kirim Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>
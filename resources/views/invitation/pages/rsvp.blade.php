<!-- RSVP Page -->
<div class="flipbook-page text-center relative overflow-hidden h-full flex flex-col justify-center bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 20% 80%, rgba(218,165,32,0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,215,0,0.06) 0%, transparent 50%);
        background-color: #fafafa;">

    <!-- Border -->
    <div class="absolute top-3 left-3 right-3 bottom-3 border border-amber-300/40 shadow-inner rounded-lg pointer-events-none"></div>

    <!-- Content -->
    <div class="flex-1 overflow-y-auto px-3 md:px-6 md:py-4 space-y-3 md:space-y-6" style="pointer-events:auto;">

        <!-- Title -->
        <h2 class="text-2xl md:text-4xl font-extrabold tracking-wide uppercase mt-4 mb-1 md:mb-4"
            style="font-family: 'Playfair Display', serif;">
            RSVP
        </h2>
        <div class="w-24 h-0.5 bg-black mx-auto mb-4"></div>

        <!-- Description -->
        <p class="text-[12px] md:text-lg text-gray-600 max-w-xs md:max-w-md leading-snug md:leading-relaxed px-1 text-center mx-auto">
            Kindly confirm your attendance below. We would love to hear your message or blessings for the couple.
        </p>

        <!-- RSVP Form -->
        <form id="rsvp-form" class="max-w-xs md:max-w-md mx-auto space-y-3 bg-white/90 p-3 md:p-5 rounded-lg shadow-lg border border-amber-100" style="pointer-events:auto;">
            
            <input 
                type="text" 
                id="guest-name" 
                value="{{ $guest->name }}" 
                readonly 
                placeholder="Full Name" 
                class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-600 text-xs md:text-sm placeholder-gray-500 cursor-text" 
                style="pointer-events:auto;"
            >

            <select 
                id="attendance" 
                class="w-full px-3 py-2 border border-gray-300 rounded text-xs md:text-sm cursor-pointer placeholder-gray-500" 
                required 
                style="pointer-events:auto;">
                <option value="">Select Attendance</option>
                <option value="1">✅ Will Attend</option>
                <option value="0">❌ Unable to Attend</option>
            </select>

            <textarea 
                id="message" 
                rows="2" 
                placeholder="Write your message or blessings..." 
                class="w-full px-3 py-2 border border-gray-300 rounded text-xs md:text-sm cursor-text placeholder-gray-500" 
                style="pointer-events:auto;"></textarea>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold py-2 px-3 rounded text-xs md:text-sm transition-all duration-300 cursor-pointer" 
                style="pointer-events:auto;">
                Send RSVP
            </button>
        </form>

        <!-- Messages Section -->
        <div id="messages-container" class="max-w-xs md:max-w-md mx-auto mt-4 space-y-2"></div>

        <!-- Pagination -->
        <div id="pagination" class="flex justify-center space-x-2 mt-3"></div>
    </div>
</div>

<!-- RSVP Script -->
<script>
    const messages = [
        { name: "Rina", message: "Selamat atas pernikahannya! Semoga bahagia selalu ❤️" },
        { name: "Budi", message: "Mohon maaf tidak bisa hadir, semoga acara lancar!" },
        { name: "Tina", message: "Congratulations and best wishes!" },
    ];

    const messagesPerPage = 3;
    let currentPage = 1;

    function renderMessages() {
        const container = document.getElementById("messages-container");
        container.innerHTML = "";

        const start = (currentPage - 1) * messagesPerPage;
        const paginatedMessages = messages.slice(start, start + messagesPerPage);

        paginatedMessages.forEach(msg => {
            const card = document.createElement("div");
            card.className = "bg-white/90 border border-amber-100 rounded-lg shadow-sm p-2 text-left animate-fadeIn";
            card.innerHTML = `
                <p class="text-xs md:text-sm font-semibold text-amber-800">${msg.name}</p>
                <p class="text-[11px] md:text-sm text-gray-700 italic">"${msg.message}"</p>
            `;
            container.appendChild(card);
        });

        renderPagination();
    }

    function renderPagination() {
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";
        const totalPages = Math.ceil(messages.length / messagesPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className =
                `px-2 py-1 text-xs rounded border ${i === currentPage ? 'bg-amber-500 text-white' : 'bg-white text-gray-700'} hover:bg-amber-400 hover:text-white transition-all`;
            btn.onclick = () => {
                currentPage = i;
                renderMessages();
            };
            pagination.appendChild(btn);
        }
    }

    document.getElementById("rsvp-form").addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("guest-name").value;
        const message = document.getElementById("message").value.trim();
        const attendance = document.getElementById("attendance").value;

        if (!attendance) return alert("Please select attendance status.");

        if (message) {
            messages.unshift({ name, message });
            renderMessages();
        }

        alert("Thank you for confirming your RSVP!");
        this.reset();
        document.getElementById("guest-name").value = name;
    });

    // Animasi sederhana
    const style = document.createElement("style");
    style.innerHTML = `
      @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
      .animate-fadeIn { animation: fadeIn 0.3s ease-in-out; }
    `;
    document.head.appendChild(style);

    renderMessages();
</script>

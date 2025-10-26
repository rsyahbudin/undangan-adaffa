<!-- RSVP Page -->
<div class="flipbook-page text-center relative overflow-hidden flex flex-col justify-center bg-[#fafafa]"
    style="background-image:
        radial-gradient(circle at 20% 80%, rgba(218,165,32,0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,215,0,0.06) 0%, transparent 50%);
        background-color: #fafafa;
        width: 380px; height: 552px;">

    <!-- Border -->
    <div
        class="absolute top-2 left-2 right-2 bottom-2 border border-amber-300/40 shadow-inner rounded-lg pointer-events-none">
    </div>

    <!-- Content -->
    <div class="flex flex-col justify-start items-center px-3 md:px-6 py-2 md:py-5 space-y-3 md:space-y-5 w-full overflow-hidden"
        style="pointer-events:auto; height:100%;">

        <!-- Title -->
        <h1 class="text-lg md:text-3xl lg:text-4xl font-extrabold tracking-wide uppercase mb-3 md:mb-4 mt-3"
            style="font-family: 'Playfair Display', serif;">
            RSVP
        </h1>
        <div class="w-16 md:w-20 lg:w-24 h-0.5 bg-black mx-auto mb-3 md:mb-4"></div>

        <!-- Description -->
        <p
            class="text-[11px] md:text-base text-gray-600 max-w-[270px] md:max-w-md leading-snug md:leading-relaxed px-1 mx-auto text-center">
            Kindly confirm your attendance below. We would love to hear your message or blessings for the couple.
        </p>


            <!-- RSVP Form -->
            <form id="rsvp-form"
                class="max-w-[300px] md:max-w-md w-full mx-auto space-y-2 bg-white/90 p-3 md:p-5 rounded-lg shadow-md border border-gray-200">
                <input type="text" id="guest-name" value="{{ $guest->name ?? '' }}" readonly
                    class="w-full px-3 py-1.5 border border-gray-300 rounded bg-gray-100 text-gray-600 text-[11px] md:text-sm placeholder-gray-500 focus:outline-none cursor-text">

                <select id="attendance"
                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-[11px] md:text-sm focus:ring-1 focus:ring-amber-400 focus:outline-none cursor-pointer"
                    required>
                    <option value="">Select Attendance</option>
                    <option value="1">✅ Will Attend</option>
                    <option value="0">❌ Unable to Attend</option>
                </select>

                <textarea id="message" rows="3" placeholder="Write your message or blessings..."
                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-[11px] md:text-sm focus:ring-1 focus:ring-amber-400 focus:outline-none resize-none"></textarea>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-1.5 px-3 rounded text-[11px] md:text-sm transition-all duration-300">
                    Send RSVP
                </button>
            </form>

            <!-- Messages Scrollable Section -->
            <div class="flex flex-col w-full max-w-[300px] md:max-w-md flex-1 overflow-hidden mt-3 md:mt-4 z-10">
                <div id="messages-container"
                    class="flex-1 overflow-y-auto overscroll-contain space-y-2 pr-1 md:pr-2 pb-2 md:pb-3
           max-h-[180px] md:max-h-[240px]">
                </div>


                <!-- Pagination fixed below messages -->
                <div id="pagination"
                    class="flex justify-center items-center flex-wrap gap-1 md:gap-2 mt-2 md:mt-3 pb-2 md:pb-3
           bg-[#fafafa] sticky bottom-0 z-10 text-[10px] md:text-lg">
                </div>

            </div>
        </div>

        <script>
            const guestId = "{{ $guest->id }}";
            const container = document.getElementById("messages-container");
            const pagination = document.getElementById("pagination");
            const form = document.getElementById("rsvp-form");
            const messagesPerPage = 3;
            let messages = [];
            let currentPage = 1;



            // Ambil semua messages dari server
            async function fetchMessages() {
                try {
                    const res = await fetch('/rsvp-messages', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) throw new Error('Failed to fetch');
                    const data = await res.json();
                    messages = Array.isArray(data.messages) ? data.messages : [];
                    currentPage = 1;
                    renderMessages();
                } catch (err) {
                    console.error('Error fetching messages:', err);
                    messages = [];
                    renderMessages();
                }
            }

            // Submit RSVP form
            form.addEventListener("submit", async function(e) {
                e.preventDefault();
                const name = document.getElementById("guest-name").value.trim();
                const message = document.getElementById("message").value.trim();
                const attendance = document.getElementById("attendance").value;

                if (!attendance) return alert("Please select attendance status.");

                try {
                    const response = await fetch(`/rsvp/${guestId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            is_attending: attendance === "1",
                            message,
                        }),
                    });

                    const result = await response.json();
                    if (response.ok && result.success) {
                        await fetchMessages();
                        form.reset();
                        document.getElementById("guest-name").value = name;
                        container.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        alert("Thank you for confirming your RSVP!");
                    } else {
                        alert(result.message || "Failed to save RSVP, please try again.");
                    }
                } catch (err) {
                    console.error("Network error while saving RSVP:", err);
                    alert("Network error, please try again.");
                }
            });

            // Render messages dengan tanda hadir / tidak hadir
            function renderMessages() {
                container.innerHTML = "";
                if (!messages.length) {
                    container.innerHTML = `<p class="text-[11px] md:text-sm text-gray-500 italic px-2">No messages yet.</p>`;
                    pagination.innerHTML = "";
                    return;
                }

                const start = (currentPage - 1) * messagesPerPage;
                const paginated = messages.slice(start, start + messagesPerPage);

                paginated.forEach(msg => {
                    const icon = msg.is_attending ?
                        '<span class="text-green-600 text-xs md:text-base ml-1">✅</span>' :
                        '<span class="text-red-500 text-xs md:text-base ml-1">❌</span>';

                    const card = document.createElement("div");
                    card.className = "bg-white/95 border border-gray-200 rounded-md shadow-sm p-2 text-left animate-fadeIn";
                    card.innerHTML = `
                <div class="flex items-center">
                    <p class="text-[11px] md:text-sm font-semibold text-amber-800 truncate">${escapeHtml(msg.guest_name || 'Guest')}</p>
                    ${icon}
                </div>
                <p class="text-[10px] md:text-sm text-gray-700 italic break-words whitespace-pre-line mt-0.5">${escapeHtml(msg.message || '')}</p>
            `;
                    container.appendChild(card);
                });

                renderPagination();
            }

            function renderPagination() {
                pagination.innerHTML = "";
                const totalPages = Math.ceil(messages.length / messagesPerPage);
                if (totalPages <= 1) return;

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement("button");
                    btn.textContent = i;
                    btn.className =
                        `px-2 py-0.5 text-[10px] rounded border ${i === currentPage
                    ? 'bg-amber-500 text-white border-amber-500'
                    : 'bg-white text-gray-700 border-gray-300'} hover:bg-amber-400 hover:text-white transition-all`;
                    btn.onclick = () => {
                        currentPage = i;
                        renderMessages();
                        container.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    };
                    pagination.appendChild(btn);
                }
            }

            // Escape helper
            function escapeHtml(unsafe) {
                if (!unsafe && unsafe !== "") return "";
                return String(unsafe)
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // Animasi halus
            const style = document.createElement("style");
            style.innerHTML = `
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.28s ease-in-out; }
    `;
            document.head.appendChild(style);

            // Hindari konflik flip event
            document.querySelectorAll('#rsvp-form, #rsvp-form *').forEach(el => {
                ['click', 'touchstart', 'touchmove', 'mousedown', 'mousemove'].forEach(evt => {
                    el.addEventListener(evt, e => e.stopPropagation(), {
                        passive: false
                    });
                });
            });

            fetchMessages();
        </script>
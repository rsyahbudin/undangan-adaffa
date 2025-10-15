@extends('layouts.app')

@section('title', 'Undangan Pernikahan')

@section('content')
<!-- Halaman Cover - Front Page -->
<div class="page">
    <div class="newspaper-date">{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
    <div class="newspaper-page-number">1</div>

    <div class="newspaper-columns">
        <div class="newspaper-column">
            <h1 class="newspaper-headline">BREAKING NEWS: Wedding Celebration</h1>
            <p class="newspaper-subheadline">Two Hearts, One Love Story</p>

            @if($wedding->settings && $wedding->settings->cover_photo)
            <img src="{{ asset('storage/' . $wedding->settings->cover_photo) }}" alt="Wedding Cover" class="newspaper-image">
            <p class="newspaper-caption">The beautiful couple on their special day</p>
            @endif

            <div class="newspaper-quote">
                "Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan putra-putri kami."
            </div>

            <p class="newspaper-text">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu kepada kedua mempelai.
            </p>
        </div>

        <div class="newspaper-column">
            <h2 class="newspaper-headline" style="font-size: 1.8rem;">Event Details</h2>

            <div class="newspaper-form">
                <h3>Akad Nikah</h3>
                <p class="newspaper-text">
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($wedding->akad_date)->format('d M Y') }}<br>
                    <strong>Waktu:</strong> {{ $wedding->akad_start_time }} - {{ $wedding->akad_end_time }}<br>
                    <strong>Tempat:</strong> {{ $wedding->akad_place }}
                </p>
            </div>

            <div class="newspaper-form">
                <h3>Resepsi</h3>
                <p class="newspaper-text">
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($wedding->reception1_date)->format('d M Y') }}<br>
                    <strong>Waktu:</strong> {{ $wedding->reception1_start_time }} - {{ $wedding->reception1_end_time }}<br>
                    <strong>Tempat:</strong> {{ $wedding->reception1_place }}
                </p>
            </div>

            @if($wedding->maps_url)
            <p class="newspaper-text">
                <a href="{{ $wedding->maps_url }}" target="_blank" style="color: #e74c3c; text-decoration: none; font-weight: 600;">
                    📍 Lihat Lokasi di Google Maps
                </a>
            </p>
            @endif
        </div>
    </div>
</div>

<!-- Halaman 2 - Bride & Groom Story -->
<div class="page">
    <div class="newspaper-date">{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
    <div class="newspaper-page-number">2</div>

    <div class="newspaper-columns">
        <div class="newspaper-column">
            <h1 class="newspaper-headline">Meet The Couple</h1>
            <p class="newspaper-subheadline">A Love Story Worth Telling</p>

            <div style="text-align: center; margin: 20px 0;">
                <img src="{{ asset('storage/' . $wedding->bride_photo) }}" alt="Bride" class="newspaper-image-small">
                <h3 style="font-family: 'Playfair Display', serif; color: #2c3e50; margin: 10px 0;">{{ $wedding->bride_name }}</h3>
                <p style="font-style: italic; color: #7f8c8d;">( {{ $wedding->bride_nickname }} )</p>
                @if($wedding->bride_father_name || $wedding->bride_mother_name)
                <p class="newspaper-text">
                    Putri dari:<br>
                    @if($wedding->bride_father_name){{ $wedding->bride_father_name }}@endif
                    @if($wedding->bride_father_name && $wedding->bride_mother_name) & @endif
                    @if($wedding->bride_mother_name){{ $wedding->bride_mother_name }}@endif
                </p>
                @endif
            </div>
        </div>

        <div class="newspaper-column">
            <div style="text-align: center; margin: 20px 0;">
                <img src="{{ asset('storage/' . $wedding->groom_photo) }}" alt="Groom" class="newspaper-image-small">
                <h3 style="font-family: 'Playfair Display', serif; color: #2c3e50; margin: 10px 0;">{{ $wedding->groom_name }}</h3>
                <p style="font-style: italic; color: #7f8c8d;">( {{ $wedding->groom_nickname }} )</p>
                @if($wedding->groom_father_name || $wedding->groom_mother_name)
                <p class="newspaper-text">
                    Putra dari:<br>
                    @if($wedding->groom_father_name){{ $wedding->groom_father_name }}@endif
                    @if($wedding->groom_father_name && $wedding->groom_mother_name) & @endif
                    @if($wedding->groom_mother_name){{ $wedding->groom_mother_name }}@endif
                </p>
                @endif
            </div>

            <div class="newspaper-quote">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                <br><br>
                <em>- QS. Ar-Rum: 21</em>
            </div>
        </div>
    </div>
</div>

<!-- Halaman 3 - Additional Information -->
<div class="page">
    <div class="newspaper-date">{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
    <div class="newspaper-page-number">3</div>

    <div class="newspaper-columns">
        <div class="newspaper-column">
            <h1 class="newspaper-headline">Wedding Information</h1>
            <p class="newspaper-subheadline">Important Details for Guests</p>

            <div class="newspaper-form">
                <h3>Protokol Kesehatan</h3>
                <p class="newspaper-text">
                    • Menggunakan masker selama acara<br>
                    • Mencuci tangan dengan sabun<br>
                    • Menjaga jarak aman<br>
                    • Jika merasa tidak sehat, mohon tidak hadir
                </p>
            </div>

            <div class="newspaper-form">
                <h3>Dress Code</h3>
                <p class="newspaper-text">
                    <strong>Akad Nikah:</strong> Baju muslim/muslimah<br>
                    <strong>Resepsi:</strong> Baju bebas rapi dan sopan
                </p>
            </div>
        </div>

        <div class="newspaper-column">
            <h2 class="newspaper-headline" style="font-size: 1.8rem;">Contact Information</h2>

            <div class="newspaper-form">
                <h3>Untuk Informasi Lebih Lanjut</h3>
                <p class="newspaper-text">
                    Silakan hubungi keluarga mempelai untuk informasi lebih detail mengenai acara pernikahan ini.
                </p>
            </div>

            <div class="newspaper-quote">
                "Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu kepada kedua mempelai."
            </div>

            <div class="newspaper-form">
                <h3>RSVP</h3>
                <p class="newspaper-text">
                    Untuk konfirmasi kehadiran, silakan hubungi keluarga mempelai atau gunakan link undangan khusus yang telah diberikan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Check if StPageFlip is available
        if (typeof St === 'undefined' || !St.PageFlip) {
            console.error('StPageFlip library not loaded, using fallback');
            // Fallback: show pages in simple scroll view
            const flipbook = document.getElementById('flipbook');
            flipbook.classList.add('flipbook-fallback');
            flipbook.style.display = 'block';
            flipbook.style.overflowY = 'auto';
            flipbook.style.height = '600px';
            document.querySelectorAll('.page').forEach(page => {
                page.style.display = 'block';
                page.style.marginBottom = '20px';
                page.style.pageBreakAfter = 'always';
            });
            return;
        }

        console.log('StPageFlip library loaded successfully');

        // Initialize StPageFlip with proper configuration
        const pageFlip = new St.PageFlip(document.getElementById('flipbook'), {
            width: 800,
            height: 600,
            size: "fixed",
            maxShadowOpacity: 0.5,
            showCover: true,
            mobileScrollSupport: false,
            useMouseEvents: true,
            swipeDistance: 30,
            clickEventForward: true,
            disableFlipByClick: false,
            usePortrait: true,
            startPage: 0,
            drawShadow: true,
            flippingTime: 1000,
            showPageCorners: true
        });

        console.log('StPageFlip initialized with config:', {
            width: 800,
            height: 600,
            size: "fixed"
        });

        // Debug: Check if flipbook element exists
        console.log('Flipbook element:', document.getElementById('flipbook'));
        console.log('Pages found:', document.querySelectorAll('.page').length);

        // Load pages from HTML
        pageFlip.loadFromHTML(document.querySelectorAll(".page"));

        // Add page flip event listeners
        pageFlip.on('flip', (e) => {
            console.log('Page flipped to:', e.data);
        });

        pageFlip.on('changeOrientation', (e) => {
            console.log('Orientation changed to:', e.data);
        });

        pageFlip.on('changeState', (e) => {
            console.log('State changed to:', e.data);
        });

        // Handle window resize for responsive design
        window.addEventListener('resize', () => {
            pageFlip.update();
        });

        // Add navigation buttons for mobile
        const navigationHTML = `
        <div class="page-navigation">
            <button id="prevPage">← Prev</button>
            <span id="pageInfo">1 / 3</span>
            <button id="nextPage">Next →</button>
        </div>
    `;

        document.body.insertAdjacentHTML('beforeend', navigationHTML);

        // Add navigation functionality
        document.getElementById('prevPage').addEventListener('click', () => {
            pageFlip.flipPrev();
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            pageFlip.flipNext();
        });

        // Update page info and button states
        function updateNavigation() {
            const currentPage = pageFlip.getCurrentPageIndex() + 1;
            const totalPages = pageFlip.getPageCount();
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            document.getElementById('pageInfo').textContent = `${currentPage} / ${totalPages}`;

            // Update button states
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
        }

        pageFlip.on('flip', (e) => {
            console.log('Page flipped to:', e.data);
            updateNavigation();
        });

        // Initial update
        updateNavigation();

        // Hide navigation on desktop, show on mobile
        function toggleNavigation() {
            const nav = document.querySelector('.page-navigation');
            if (window.innerWidth > 768) {
                nav.style.display = 'none';
            } else {
                nav.style.display = 'flex';
            }
        }

        toggleNavigation();
        window.addEventListener('resize', toggleNavigation);
    });
</script>
@endpush
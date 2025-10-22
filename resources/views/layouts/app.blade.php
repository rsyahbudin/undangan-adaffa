<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <title>@yield('title', 'Undangan')</title>

  <!-- Tailwind CSS / Vite -->
  @vite('resources/css/app.css')

  <!-- StPageFlip CSS -->
  <link rel="stylesheet" href="https://unpkg.com/stpageflip/dist/stpageflip.min.css" />

  <!-- Swiper CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  <style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;600&display=swap');

    body {
      background: #000000;
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: 'Lato', sans-serif;
    }


    .flipbook-page {
      background: #fafafa;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      box-sizing: border-box;
      font-family: 'Lato', sans-serif;
      position: relative;
      overflow: hidden;
      box-shadow:
        0 0 20px rgba(0, 0, 0, 0.1),
        inset 0 0 50px rgba(0, 0, 0, 0.02);
    }

    .flipbook-page::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image:
        radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.05) 1px, transparent 0);
      background-size: 20px 20px;
      opacity: 0.3;
      pointer-events: none;
    }

    .flipbook-page::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg,
          rgba(139, 69, 19, 0.03) 0%,
          transparent 50%,
          rgba(160, 82, 45, 0.03) 100%);
      pointer-events: none;
    }

    .flipbook-page img {
      max-width: 100%;
      object-fit: cover;
      border-radius: 4px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Newspaper specific styles */
    .newspaper-page {
      background: #fafafa;
      position: relative;
    }

    .newspaper-page::before {
      background-image:
        radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.08) 1px, transparent 0);
      background-size: 15px 15px;
      opacity: 0.4;
    }

    .newspaper-page::after {
      background: linear-gradient(135deg,
          rgba(139, 69, 19, 0.05) 0%,
          transparent 30%,
          rgba(160, 82, 45, 0.05) 70%,
          transparent 100%);
    }

    /* Vintage newspaper typography */
    .newspaper-headline {
      font-family: 'Times New Roman', serif !important;
      font-weight: 900;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
      letter-spacing: -0.02em;
    }

    .newspaper-text {
      font-family: 'Times New Roman', serif !important;
      line-height: 1.4;
    }

    .newspaper-border {
      border: 2px solid #333;
      box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1);
    }

    /* Vintage photo effect */
    .vintage-photo {
      filter: sepia(20%) contrast(1.1) brightness(0.95);
      border: 3px solid #333;
      box-shadow:
        0 4px 8px rgba(0, 0, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    /* Fix pointer events for interactive elements */
    .flipbook-page iframe,
    .flipbook-page input,
    .flipbook-page select,
    .flipbook-page textarea,
    .flipbook-page button,
    .flipbook-page a,
    .interactive-element {
      pointer-events: auto !important;
    }

    /* Prevent flipbook from interfering with form elements */
    .flipbook-page form {
      pointer-events: auto !important;
    }

    .flipbook-page form * {
      pointer-events: auto !important;
    }

    /* YouTube video specific fixes */
    .youtube-video {
      pointer-events: auto !important;
      position: relative !important;
      z-index: 999 !important;
    }

    .youtube-video iframe {
      pointer-events: auto !important;
      position: relative !important;
      z-index: 1000 !important;
    }

    /* Ensure video container allows interaction */
    .flipbook-page .youtube-video,
    .flipbook-page .youtube-video * {
      pointer-events: auto !important;
    }

    /* Fix for radio buttons specifically */
    .flipbook-page input[type="radio"] {
      pointer-events: auto !important;
      cursor: pointer !important;
      position: relative !important;
      z-index: 10 !important;
    }

    .flipbook-page label {
      pointer-events: auto !important;
      cursor: pointer !important;
    }



    /* PageFlip responsive container */
    #flipbook-container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Disable PageFlip interaction on interactive elements */
    .st-pageflip .flipbook-page iframe,
    .st-pageflip .flipbook-page input,
    .st-pageflip .flipbook-page select,
    .st-pageflip .flipbook-page textarea,
    .st-pageflip .flipbook-page button,
    .st-pageflip .flipbook-page a,
    .st-pageflip .flipbook-page label {
      pointer-events: auto !important;
      z-index: 1000 !important;
      position: relative !important;
    }

    /* Ensure PageFlip doesn't capture events on interactive elements */
    .st-pageflip .flipbook-page {
      pointer-events: auto;
    }

    .st-pageflip .flipbook-page * {
      pointer-events: inherit;
    }

    /* Ensure PageFlip takes available space on mobile */
    @media (max-width: 768px) {
      #flipbook-container {
        padding: 10px;
        min-height: 100vh;
      }

      .st-pageflip {
        max-width: 100vw !important;
        max-height: 85vh !important;
      }
    }

    @media (max-width: 480px) {
      #flipbook-container {
        padding: 5px;
      }

      .st-pageflip {
        max-width: 100vw !important;
        max-height: 90vh !important;
      }
    }

    /* Desktop: prevent overflow and scroll */
    @media (min-width: 769px) {
      body {
        overflow: hidden;
      }

      #flipbook-container {
        height: 100vh;
        overflow: hidden;
      }

      .st-pageflip {
        max-width: 800px !important;
        max-height: 900px !important;
      }
    }

    /* Navigation controls styling */
    .st-pageflip-nav {
      background: rgba(102, 126, 234, 0.8) !important;
      border-radius: 20px !important;
    }

    .st-pageflip-nav button {
      background: rgba(255, 255, 255, 0.9) !important;
      color: #000000 !important;
      border-radius: 50% !important;
      width: 40px !important;
      height: 40px !important;
    }
  </style>

  @stack('head')
</head>

<body>


  @yield('content')

  <!-- StPageFlip JS -->
  <script src="{{ asset('js/page-flip.browser.js') }}"></script>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  @stack('scripts')



  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Daftar elemen yang tidak boleh trigger flip
      const interactiveElements = document.querySelectorAll(
        '.flipbook-page img, .flipbook-page iframe, .flipbook-page button, .flipbook-page a, .flipbook-page .interactive-element'
      );

      interactiveElements.forEach(el => {
        el.addEventListener('click', e => {
          e.stopPropagation(); // ❗ Hentikan klik supaya tidak flip halaman
        });
        el.addEventListener('touchstart', e => {
          e.stopPropagation(); // ❗ Hentikan gesture flip saat disentuh di mobile
        });
      });
    });
  </script>

</body>

</html>
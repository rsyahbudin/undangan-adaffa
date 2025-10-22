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
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Undangan')</title>

  <!-- Tailwind CSS / Vite -->
  @vite('resources/css/app.css')

  <!-- StPageFlip CSS -->
  <link rel="stylesheet" href="https://unpkg.com/stpageflip/dist/stpageflip.min.css" />

  <style>
    body {
      background: #f0f0f0;
    }

    .flipbook {
      width: 800px;
      height: 600px;
      margin: 50px auto;
      perspective: 1500px;
    }

    .flipbook .page {
      width: 100%;
      height: 100%;
      background: #fff;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
      box-sizing: border-box;
    }

    .flipbook img {
      max-width: 100%;
      max-height: 200px;
      object-fit: cover;
    }

    .flipbook h1, .flipbook h2, .flipbook p {
      text-align: center;
      margin: 5px 0;
    }
  </style>

  @stack('head')
</head>

<body class="flex justify-center items-center min-h-screen">
  @yield('content')

  <!-- StPageFlip JS -->
  <script src="https://unpkg.com/stpageflip/dist/stpageflip.min.js"></script>
  @stack('scripts')
</body>
</html>

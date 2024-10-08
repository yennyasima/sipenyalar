<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('./css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="{{ \App\Helpers\Helper::viteAsset('resources/css/app.css') }}">
    <script type="module" src="{{ \App\Helpers\Helper::viteAsset('resources/js/app.js') }}"></script> -->
    <link rel="icon" href="{{ asset('./assets/images/logo.png') }}" type="image.png">
</head>

<body class="min-h-screen w-full bg-cover bg-center bg-no-repeat object-cover"
    style="background-image: url('{{ asset('./assets/background/landingpage.png') }}');">
    <div id="preloader"></div>
    <div id="imageModal" class="modal z-[999]">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    @include('components.landingPage.navbar')
    @yield('content')

    <!-- External JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- App JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>

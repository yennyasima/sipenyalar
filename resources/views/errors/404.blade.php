<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Page Not Found</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{--  @vite(['resources/css/app.css', 'resources/js/app.js'])  --}}
    <link rel="stylesheet" href="{{ \App\Helpers\Helper::viteAsset('resources/css/app.css') }}">
    <script type="module" src="{{ \App\Helpers\Helper::viteAsset('resources/js/app.js') }}"></script>
    <link rel="icon" href="{{ asset('./assets/images/404.png') }}" type="image/png">
</head>

<body>
    <div class="flex justify-center items-center min-h-screen w-full bg-cover bg-center bg-no-repeat"
        style="background-image: url('./assets/background/landingpage2.png');">

        <img src="{{ asset('./assets/images/404.png') }}" class="h-[500px] w-auto" alt="">
        {{-- <a href="/"
            class="hover:text-white w-[300px] text-[#6B5E36] font-inter font-semibold border-[2px] border-[#6B5E36] hover:bg-[#6B5E36] focus:ring-4 focus:ring-blue-300 font-medium rounded-[16px] text-[14px] px-2 text-center md:px-4 py-2.5 my-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            BACK TO HOME
        </a> --}}
    </div>
</body>

</html>

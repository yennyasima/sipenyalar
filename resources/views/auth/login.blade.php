<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SIPENYALAR</title>

    <!-- Tailwind CSS -->
    {{--  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/custom.css'])  --}}
    <link rel="stylesheet" href="{{ \App\Helpers\Helper::viteAsset('resources/css/app.css') }}">
    <script type="module" src="{{ \App\Helpers\Helper::viteAsset('resources/js/app.js') }}"></script>


    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" />
</head>

<body class="h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('./assets/background/hero.png');">
    @include('components.landingPage.navbar')
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
        <div class="w-full h-[154px] rounded-[8px] mb-4"
            style="background: linear-gradient(180deg,  #D95639 20%, #D95639 36%, #DC2265 76%  );">
            <!-- Bagian ini bisa diisi dengan logo atau gambar -->
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2 font-semibold">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-2 border border-gray-300 rounded-[8px] pl-[15px]" placeholder="Email" required>
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2 font-semibold">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full p-2 border border-gray-300 rounded-[8px] pl-[15px]" placeholder="Password" required>
                @error('password')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Toggle switch untuk fitur Ingat Saya -->
            <div class="mb-4 flex items-center">
                <label for="remember" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="remember" name="remember" class="sr-only">
                        <div class="w-10 h-4 bg-gray-300 rounded-full shadow-inner toggle-bg"></div>
                        <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                    </div>
                    <div class="ml-3 text-gray-700 font-semibold">Ingat Saya</div>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="text-white bg-gradient-to-r bg-[#D95639] hover:bg-[#DC2265] focus:ring-4 focus:outline-none font-medium rounded-[8px] w-full text-sm px-5 py-2.5 text-center me-2 mb-2 font-anek-latin font-extrabold">Login</button>
            </div>
        </form>
    </div>

    <!-- Font Awesome for icons (used for Twitter icon) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        // Script untuk mengubah status toggle switch
        const rememberCheckbox = document.getElementById('remember');
        const toggleBg = document.querySelector('.toggle-bg');
        const toggleDot = document.querySelector('.dot');

        rememberCheckbox.addEventListener('change', function() {
            if (this.checked) {
                toggleBg.classList.remove('bg-gray-300');
                toggleBg.classList.add('bg-green-500');
                toggleDot.classList.remove('-left-1');
                toggleDot.classList.add('translate-x-full');
            } else {
                toggleBg.classList.remove('bg-green-500');
                toggleBg.classList.add('bg-gray-300');
                toggleDot.classList.remove('translate-x-full');
                toggleDot.classList.add('-left-1');
            }
        });
    </script>
</body>

</html>

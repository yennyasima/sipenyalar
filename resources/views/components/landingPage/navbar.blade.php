<nav id="{{ request()->is('/') ? 'navbar' : 'navbar-login' }}"
    class="md:bg-transparent border-gray-200 drop-shadow-lg sticky top-0 z-50 transition-all duration-300">
    <div class="flex justify-between px-[58px] py-3">
        <a href="/" class="flex items-center rtl:space-x-reverse md:pl-0 pl-[20px]">
            <div id='appName' class="flex justify-center font-bold ">
                SIPENYALAR
            </div>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto item" id="navbar-default">
            <ul
                class="font-medium font-Anek flex uppercase flex-col md:items-center p-2 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-9 rtl:space-x-reverse md:mt-0 md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="/"
                        class="font-Anek font-bold text-[17px] block py-2 hover:text-[#D95639] {{ Request::is('/') ? 'text-[#D95639]' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/peta"
                        class="font-Anek font-bold text-[17px] block py-2 hover:text-[#D95639] {{ Request::is('peta') ? 'text-[#D95639]' : '' }}">
                        Peta
                    </a>
                </li>
                <li>
                    <a href="/grafik"
                        class="font-Anek font-bold text-[17px] block py-2 hover:text-[#D95639] {{ Request::is('grafik*') ? 'text-[#D95639]' : '' }}">
                        Grafik
                    </a>
                </li>
                <li>
                    <a href="/artikel"
                        class="font-Anek font-bold text-[17px] block py-2 hover:text-[#D95639] {{ Request::is('artikel*') ? 'text-[#D95639]' : '' }}">
                        Artikel
                    </a>
                </li>

                <li>
                    <a href="/login"
                        class="font-Anek group items-center font-bold text-[17px] flex flex-row py-2 hover:text-[#D95639] {{ Request::is('login') ? 'text-[#D95639]' : '' }}">
                        LOGIN
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            class="transition-colors duration-300
            {{ Request::is('login') ? 'fill-[url(#gradient1)]' : '' }}
            group-hover:fill-[#D95639]">
                            <path
                                d="M12 21v-2h7V5h-7V3h7q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm-2-4l-1.375-1.45l2.55-2.55H3v-2h8.175l-2.55-2.55L10 7l5 5z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
{{-- <script src="./js/app.js"></script> --}}

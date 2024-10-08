@extends('layouts.landingpage')

@section('title', 'SIPENYALAR')

@section('content')
    <div class="flex flex-col justify-center items-center px-4 md:px-[200px] py-[40px] mt-[100px]">
        <h1 class="font-Anek font-bold text-[32px] md:text-[64px] text-[#D95639]" data-aos="fade-up" data-aos="fade-up">ALL
            ARTICLE
            ABOUT GIS
        </h1>
        <p class="md:text-center text-justify pt-2 text-lg sm:text-xl md:text-[24px] mb-5 md:px-[250px] font-inter text-black ont-extralight"
            data-aos="fade-up">
            Find the latest updates on education and information about DBD, HIV, ISPA diseases .
        </p>
        <form class="max-w-lg md:w-[1500px] mx-auto mb-10" method="GET" action="{{ route('home.artikel') }}"
            data-aos="fade-up">
            <div class="flex">
                <select id="category" name="category"
                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200">
                    <option value="" disabled selected>Select Category</option>
                    <option value="ISPA">Penyakit ISPA</option>
                    <option value="HIV">Penyakit HIV</option>
                    <option value="DBD">Penyakit DBD</option>

                </select>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="search"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50"
                        placeholder="Search..." />
                    <button type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-gradient-to-br bg-[#D95639] hover:bg-[#DC2265] hover:bg-gradient-to-bl w-[40px] rounded-r-lg">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($news as $index => $item)
                <div class="flex flex-col justify-start items-start bg-[#D95639]/15 rounded-[24px] pb-[60px] h-auto md:h-[400px]"
                    data-aos="fade-up" data-aos="fade-up">
                    <div class="relative flex flex-row items-center justify-start w-full">
                        <img class="rounded-t-[24px] h-[175px] w-full object-cover object-center"
                            src="{{ asset('./storage/banner_news/' . $item->banner) }}">
                        <h2
                            class="absolute bottom-2 right-2 text-white font-Anek text-[14px] bg-[#121440] rounded-full w-max px-[13px] py-1">
                            PENYAKIT {{ $item->category }}
                        </h2>
                    </div>
                    <div class="px-[20px] flex flex-col gap-y-3 pt-[10px] pb-[20px]">
                        <div class="flex flex-row justify-between gap-x-2 items-center">
                            <h1 class="font-Anek font-bold text-[20px] uppercase text-[#D95639]">
                                {{ $item->title }}
                            </h1>
                        </div>
                        <p class="font-inter text font-light">
                            {{ Str::limit(strip_tags($item->deskripsi), 150) }}...</p>
                        <a href="/artikel/{{ $item->id }}"
                            class="text-black hover:text-white w-[180px] duration-200 md:w-[100px] border border-[2px] border-[#D95639] hover:border hover:border-[#F9F9F9]/15 hover:rounded-full= hover:border-[2px] font-Anek hover:bg-[#DC2265] hover:bg-gradient-to-bl font-bold rounded-full text-[10px] px-4 md:px-1 py-2.5 text-center me-2 mb-4 md:mb-2">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection

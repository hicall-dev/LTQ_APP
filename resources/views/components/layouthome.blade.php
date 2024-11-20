<!DOCTYPE html>
<html lang="en" class="bg-gray-200">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- <title>HOME</title> --}}

</head>

<x-navbarhome></x-navbarhome>

<body class="bg-cyan-200">
    <div class="min-h-full">
        <main>
            {{-- BANNER --}}
            <picture class="">
                <source media="(min-width: 768px)" srcset="{{ asset('img/banner2.jpg') }}">
                {{-- <source media="(min-width: 960px)" srcset="{{ asset('img/banner3.png') }}"> --}}
                <img src="{{ asset('img/banner.jpg') }}" alt="">
            </picture>
            {{-- <div class="">
                <img src="{{ asset('img/channels4_banner.jpg') }}" alt="">
            </div> --}}
            {{-- <div class="py-10 "
                style="background-image: url('{{ asset('/img/pic_1.jpg') }}'); background-size: cover; background-position: center;">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 ">
                    <div class="flex justify-center items-center md:flex-row flex-col bg-cyan-400/50">
                        <div>
                            <img src="{{ asset('/img/logo.png') }}" alt="" class="w-48 h-48 my-2">
                        </div>
                        <div class=" text-center text-white mx-5 px-5">
                            <h1 class=" mb-1 lg:text-2xl text-xl tracking-wide font-bold ">LEMBAGA PENDIDIKAN
                                TAHSIN &
                                TAHFIZH ALQURAN
                            </h1>
                            <h1 class=" mb-1 lg:text-6xl text-3xl tracking-wide font-bold ">KHOIRUNNASYIEN
                            </h1>
                            <h1 class=" mb-1 text-sm italic tracking-wide font-bold ">Mencerdaskan tunas muda dengan
                                Alquran
                                &
                                Membahagiakan keluarga
                            </h1>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="mx-auto h-full max-w-7xl px-4 pt-2 pb-32 sm:px-6 lg:px-8 bg-white">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

<x-footerhome></x-footerhome>

</html>

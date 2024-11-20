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
    <div class=" min-h-screen">
        <main>
            {{-- BANNER --}}
            <picture class="">
                <source media="(min-width: 768px)" srcset="{{ asset('img/banner2.jpg') }}">
                <img src="{{ asset('img/banner1.jpg') }}" alt="">
                </picture>
            <div class="mx-auto max-w-7xl px-4 pt-2 pb-32 sm:px-6 lg:px-8 bg-white">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
    <x-footerhome></x-footerhome>
</body>


</html>

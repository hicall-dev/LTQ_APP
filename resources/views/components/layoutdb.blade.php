<!DOCTYPE html>
<html lang="en" bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $title }}</title>
</head>

<x-navbardb>{{ $title }}</x-navbardb>
<body>
    <div class="min-h-screen">
        <div class="mx-auto max-w-7xl px-4 mt-10 pt-2 pb-32 sm:px-6 lg:px-8 bg-white">
            {{ $slot }}
        </div>
    </div>
    <x-footerdb></x-footerdb>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>

<nav class="bg-gray-800" x-data="{ isOpen: false }" x-init="isOpen = false">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                <div class="max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <a href="/dashboard/santri/" class="rounded-md bg-gray-900 py-2 text-sm font-medium text-white"
                        aria-current="page">
                        <h1 class="text-3xl font-bold tracking-tight text-white">{{ $slot }}</h1>
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class=" md:block">
                    <div class=" flex items-baseline">
                        <p class="rounded-md py-2 text-sm font-medium text-gray-300 mr-2">
                            {{ isset(auth()->user()->name) ? auth()->user()->name : '' }}</p>
                        <p class="rounded-md py-2 text-sm font-medium text-gray-300">|</p>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit"
                                class="rounded-md bg-gray-900 hover:bg-red-700 px-3 py-2 text-sm font-medium text-white ml-2"
                                aria-current="page">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

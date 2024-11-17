<header class=" shadow sticky top-0 z-10 bg-blue-800 text-white" x-data="{ isOpen: false, isOpenP: false }">
    <nav class="mx-auto flex max-w-8xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <a href="/" class="-m-1.5   ">
            <div class="flex lg:flex-1 items-center">
                <div class="">
                    <img class="h-12 w-auto" src="{{ asset('/img/logo.png') }}" alt="">
                </div>
                <div class="mx-4">
                    <p class=" text-sm font-semibold ">
                        LEMBAGA PENDIDIKAN TAHSIN & TAHFIZH AL-QURAN
                    </p>
                    <p class="text-base/5 font-semibold ">
                        KHOIRUNNASYIEN
                    </p>
                </div>
            </div>
        </a>
        <div class="flex lg:hidden" @click="isOpen = !isOpen">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:gap-x-12 lg:justify-end">
            <a href="{{ asset('download/Informasi_Lembaga.pdf') }}" class="text-base/7 font-semibold ">INFORMASI
                LEMBAGA</a>
            <a href="/pendaftaran#pendaftaran" class="text-base/7 font-semibold ">PENDAFTARAN</a>
            <a href="/cek_spp#cek" class="text-base/7 font-semibold ">CEK SPP SANTRI</a>
            <a href="/cek_kelas#cek" class="text-base/7 font-semibold ">CEK PERKEMBANGAN SANTRI</a>
            {{-- <a href="/profile" class="text-base/7 font-semibold ">Profil</a>
            <a href="#" class="text-base/7 font-semibold ">Program</a>
            <a href="#" class="text-base/7 font-semibold ">Kelas</a>
            <a href="#" class="text-base/7 font-semibold ">Informasi Pendaftaran</a>
            <a href="#" class="text-base/7 font-semibold ">Cek Santri <span
                    aria-hidden="true">&rarr;</span></a> --}}
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true" x-show="isOpen">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10">
            <div
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-blue-800 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="/" class="-m-1.5 p-1.5">
                        <div class="flex lg:flex-1 items-center">
                            <div class="">
                                <img class="h-8 w-auto" src="{{ asset('/img/logo.png') }}" alt="">
                            </div>
                            <div class="mx-4">
                                <p class="text-base/5 font-semibold ">
                                    KHOIRUNNASYIEN
                                </p>
                            </div>
                        </div>
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-white" @click="isOpen = !isOpen">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-cyan-500">
                        <div class="space-y-2 py-6">
                            <a href="{{ asset('download/Informasi_Lembaga.pdf') }}"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold  hover:bg-blue-400">INFORMASI
                                LEMBAGA</a>
                            <a href="/pendaftaran#pendaftaran"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold  hover:bg-blue-400">PENDAFTARAN</a>
                            <a href="/cek_spp#cek"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold  hover:bg-blue-400">CEK
                                SPP SANTRI</a>
                            <a href="/cek_kelas#cek"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold  hover:bg-blue-400">CEK
                                PERKEMBANGAN SANTRI</a>
                        </div>
                        {{-- <div class="py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold  hover:bg-blue-400">Cek
                                Santri</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

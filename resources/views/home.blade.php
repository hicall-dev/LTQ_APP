<head>
    <title>
        {{ $title }}
    </title>
</head>
<x-layouthome>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="my-10">
        <div
            class=" left-0 text-2xl px-4 pt-2 pb-4 rounded-xl my-4 text-white top-0 h-fit bg-gradient-to-r from-cyan-400 to-blue-500">
            <p class="mb-4">
                "Cari tahu lebih lanjut mengenai visi, misi, dan kelas yang ditawarkan oleh lembaga kami dalam
                mengajarkan dan membentuk generasi penghafal Al-Quran."
            </p>
            <a href="{{ asset('download/Informasi_Lembaga.pdf') }}"
                class="p-2 bg-blue-500 w-fit rounded-xl my-5">INFORMASI LEMBAGA</a>
        </div>
        <div
            class=" left-0 text-2xl px-4 pt-2 pb-4 rounded-xl my-4 text-white top-0 h-fit bg-gradient-to-l from-cyan-400 to-blue-500">
            <p class="mb-4">
                "Ingin mendaftarkan anak anda untuk bergabung? Dapatkan informasi lengkap mengenai persyaratan, jadwal
                belajar, biaya, dan tata cara pendaftaran untuk menjadi bagian dari lembaga kami."
            </p>
            <a href="/pendaftaran#pendaftaran" class="p-2 bg-cyan-400 w-fit rounded-xl my-5">PENDAFTARAN</a>
        </div>
        <div
            class=" left-0 text-2xl px-4 pt-2 pb-4 rounded-xl my-4 text-white top-0 h-fit bg-gradient-to-r from-cyan-400 to-blue-500">
            <p class="mb-4">
                "Pantau status pembayaran SPP santri Anda cukup dengan memasukkan NIS santri. Klik di sini untuk
                mengecek pembayaran yang sudah dan belum diselesaikan."
            </p>
            <a href="/cek_spp#cek" class="p-2 bg-blue-500 w-fit rounded-xl my-5">CEK SPP SANTRI</a>
        </div>
        <div
            class=" left-0 text-2xl px-4 pt-2 pb-4 rounded-xl my-4 text-white top-0 h-fit bg-gradient-to-l from-cyan-400 to-blue-500">
            <p class="mb-4">
                "Ketahui sejauh mana perkembangan santri? Cek kelas dan materi santri di sini."
            </p>
            <a href="/cek_kelas#cek" class="p-2 bg-cyan-400 w-fit rounded-xl my-5">CEK PERKEMBANGAN SANTRI</a>
        </div>
    </div>

    {{-- PROMO --}}
    <div id="image-modal"
        class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black/50">
        <div class="relative">
            <!-- Tombol Close -->
            <button type="button"
                class="absolute top-4 right-4 text-white bg-cyan-500 hover:bg-cyan-400 rounded-full text-sm w-10 h-10 flex justify-center items-center shadow-lg font-bold"
                onclick="closeModal()">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>


            <!-- Gambar -->
            <img src="{{ asset('img/popup.jpg') }}?v={{ time() }}" alt="Popup Image"
                class="rounded-lg shadow-lg max-w-lg w-full">
        </div>
    </div>
    <script>
        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('image-modal');
            modal.classList.add('hidden'); // Sembunyikan modal
        }
    </script>
</x-layouthome>

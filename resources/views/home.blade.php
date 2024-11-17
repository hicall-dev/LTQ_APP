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
            <a href="{{ asset('download/Informasi_Lembaga.pdf') }}" class="p-2 bg-blue-500 w-fit rounded-xl my-5">INFORMASI LEMBAGA</a>
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

</x-layouthome>

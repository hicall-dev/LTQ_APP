<head>
    <title>
        {{ $title }}
    </title>
</head>
<x-layouthome>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div id="pendaftaran" class="my-10">
        <h1 class="text-3xl font-bold text-center tracking-widest py-5 border-b-4 border-blue-500">
            PENDAFTARAN</h1>
        <form action="/daftar" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto space-y-6 ">
            @csrf

            <!-- Bagian Santri -->
            <h2 class="text-xl font-semibold text-gray-700">Data Santri
                <span class="align-top text-xs font-semibold text-gray-700">*Santri yang didaftarkan</span>
            </h2>

            <div class="flex items-center space-x-4">
                <label for="nama_santri" class="w-1/3 text-gray-700 font-semibold">Nama</label>
                <input type="text" id="nama_santri" name="nama_santri" value="{{ old('nama_santri') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label class="text-gray-700 font-semibold w-1/3">Jenis Kelamin</label>
                <div class="flex items-center space-x-6 w-2/3">
                    <div>
                        <input type="radio" id="laki_laki" name="jenis_kelamin" value="Laki-laki"
                            class="text-blue-600 focus:ring-blue-200" onclick="toggleKelas()">
                        <label for="laki_laki" class="text-gray-700">Laki-laki</label>
                    </div>
                    <div>
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                            class="text-pink-600 focus:ring-pink-200" onclick="toggleKelas()">
                        <label for="perempuan" class="text-gray-700">Perempuan</label>
                    </div>
                </div>
            </div>


            <div class="flex items-center space-x-4">
                <label for="nama_ayah" class="w-1/3 text-gray-700 font-semibold">Nama Ayah Kandung</label>
                <input type="text" id="nama_ayah" name="nama_ayah"
                    value="{{ old('nama_ayah') }}"class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="ttl_santri" class="w-1/3 text-gray-700 font-semibold">Tempat Tanggal Lahir</label>
                <input type="text" id="ttl_santri" name="ttl_santri"
                    value="{{ old('ttl_santri') }}"class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="alamat_santri" class="w-1/3 text-gray-700 font-semibold">Alamat</label>
                <input type="text" id="alamat_santri" name="alamat_santri" value="{{ old('alamat_santri') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="wa_santri" class="w-1/3 text-gray-700 font-semibold">No. WhatsApp</label>
                <input type="text" id="wa_santri" name="wa_santri" value="{{ old('wa_santri') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="asal_sekolah" class="w-1/3 text-gray-700 font-semibold">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <br>
            <hr class="border-t border-blue-500 my-8">

            <!-- Bagian Wali Santri -->
            <h2 class="text-xl font-semibold text-gray-700 mt-8">Data Wali Santri
                <span class="align-top text-xs font-semibold text-gray-700">*Orang yang mendaftarkan</span>
            </h2>

            <div class="flex items-center space-x-4">
                <label for="nama_wali" class="w-1/3 text-gray-700 font-semibold">Nama</label>
                <input type="text" id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="ttl_wali" class="w-1/3 text-gray-700 font-semibold">Tempat Tanggal Lahir</label>
                <input type="text" id="ttl_wali" name="ttl_wali" value="{{ old('ttl_wali') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="alamat_wali" class="w-1/3 text-gray-700 font-semibold">Alamat</label>
                <input type="text" id="alamat_wali" name="alamat_wali" value="{{ old('alamat_wali') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex items-center space-x-4">
                <label for="wa_wali" class="w-1/3 text-gray-700 font-semibold">No. WhatsApp</label>
                <input type="text" id="wa_wali" name="wa_wali" value="{{ old('wa_wali') }}"
                    class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <!-- Bagian Santri -->
            <br>
            <hr class="border-t border-blue-500 my-8">
            <h2 class=" text-xs font-semibold text-gray-700">*Jadwal Kelas akan muncul ketika Jenis Kelamin telah diisi
            </h2>
            <h2 class="text-xl font-semibold text-gray-700">Jadwal Kelas</h2>

            <div id="kelas_laki_laki" class="hidden">
                <div class="flex items-center space-x-4">
                    <label class="text-gray-700 font-semibold w-1/3">Pilih Waktu</label>
                    <div class="flex items-center space-x-6 w-2/3">
                        <div>
                            <input type="radio" id="kelas_sore" name="kelas" value="Putra Sore"
                                class="text-blue-600 focus:ring-blue-200">
                            <label for="kelas_sore" class="text-gray-700">Putra Sore</label>
                        </div>
                        <div>
                            <input type="radio" id="kelas_malam" name="kelas" value="Putra Malam"
                                class="text-blue-600 focus:ring-blue-200">
                            <label for="kelas_malam" class="text-gray-700">Putra Malam</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="kelas_perempuan" class="hidden">
                <div class="flex items-center space-x-4">
                    <label class="text-gray-700 font-semibold w-1/3">Pilih Kelas</label>
                    <div class="flex items-center space-x-6 w-2/3">
                        <div>
                            <input type="radio" id="kelas_pagi" name="kelas" value="Putri Pagi"
                                class="text-pink-600 focus:ring-pink-200">
                            <label for="kelas_pagi" class="text-gray-700">Putri Pagi</label>
                        </div>
                        <div>
                            <input type="radio" id="kelas_ahad" name="kelas" value="Putri Ahad"
                                class="text-pink-600 focus:ring-pink-200">
                            <label for="kelas_ahad" class="text-gray-700">Putri Ahad</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label for="signature" class="block text-gray-700 font-semibold mb-2">Tanda Tangan</label>
                <canvas id="signature" width="300" height="200" class="border-2 border-gray-400"></canvas>
                <input type="hidden" id="signature_data" name="signature_data">
            </div>

            <div class="mb-6">
                <button type="button" id="clear" class="bg-gray-300 p-2 rounded-md">Clear</button>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                    Daftar
                </button>
            </div>
        </form>
    </div>
    <script>
        function toggleKelas() {
            // Menyembunyikan semua pilihan kelas terlebih dahulu
            document.getElementById("kelas_laki_laki").classList.add("hidden");
            document.getElementById("kelas_perempuan").classList.add("hidden");

            // Menampilkan pilihan kelas berdasarkan jenis kelamin yang dipilih
            if (document.getElementById("laki_laki").checked) {
                document.getElementById("kelas_laki_laki").classList.remove("hidden");
            } else if (document.getElementById("perempuan").checked) {
                document.getElementById("kelas_perempuan").classList.remove("hidden");
            }
        }

        // CANVAS

        const canvas = document.getElementById('signature');
        const signatureData = canvas.toDataURL(); // Ambil data base64 dari canvas
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        // Setup untuk menggambar
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('touchstart', startDrawing);

        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('touchmove', draw);

        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('touchend', stopDrawing);

        // Atur ketebalan garis
        ctx.lineWidth = 5; // Anda bisa mengganti angka ini dengan ketebalan yang diinginkan

        // Atur warna garis jika diperlukan
        ctx.strokeStyle = "#000"; // Warna hitam, bisa diganti dengan warna lain

        // Mulai menggambar
        function startDrawing(e) {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(getPosition(e).x, getPosition(e).y);

            // Disable scroll saat menggambar
            disableScroll(true);

            // Mencegah perilaku default pada touch event di perangkat mobile
            if (e.type === "touchstart" || e.type === "touchmove") {
                e.preventDefault(); // Mencegah scroll
            }
        }

        // Gambar tanda tangan
        function draw(e) {
            if (!isDrawing) return;
            const {
                x,
                y
            } = getPosition(e);
            ctx.lineTo(x, y);
            ctx.stroke();
        }

        // Hentikan menggambar
        function stopDrawing(e) {
            isDrawing = false;
            ctx.closePath();
            // Enable scroll kembali
            disableScroll(false);

            // Update data untuk disubmit
            document.getElementById('signature_data').value = canvas.toDataURL();
        }

        // Menangani posisi mouse/touch
        function getPosition(e) {
            const rect = canvas.getBoundingClientRect();
            const x = (e.clientX || e.touches[0].clientX) - rect.left;
            const y = (e.clientY || e.touches[0].clientY) - rect.top;
            return {
                x,
                y
            };
        }

        // Clear tombol
        document.getElementById('clear').addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            document.getElementById('signature_data').value = '';
        });

        // Fungsi untuk menonaktifkan/mengaktifkan scroll
        function disableScroll(disable) {
            if (disable) {
                // Menonaktifkan scroll pada seluruh halaman
                document.body.style.overflow = 'hidden';
                window.addEventListener('touchmove', preventDefault, {
                    passive: false
                });
            } else {
                // Mengaktifkan scroll kembali
                document.body.style.overflow = '';
                window.removeEventListener('touchmove', preventDefault, {
                    passive: false
                });
            }
        }

        // Fungsi untuk mencegah scroll pada perangkat mobile
        function preventDefault(e) {
            e.preventDefault();
        }

        // Kirimkan data ke input hidden sebelum form submit
        document.getElementById('daftarForm').onsubmit = function(event) {

            // Cek jika tanda tangan ada
            if (signatureData !== 'data:,') {
                // Jika ada tanda tangan, simpan data dalam input hidden
                document.getElementById('signature_data').value = signatureData;
            } else {
                // Jika tidak ada tanda tangan, biarkan input hidden kosong
                document.getElementById('signature_data').value = '';
            }
        };
    </script>





</x-layouthome>
{{-- <div id="pendaftaran" class="my-10">
    <h1 class="text-3xl font-bold text-center tracking-widest py-5 border-b-4 border-blue-500">
        PENDAFTARAN</h1>
    <div class="grid justify-center items-center">
        <div class="w-fit px-5 pt-5 rounded-lg shadow-md">
            <h1
                class=" mb-1 w-full text-center text-3xl tracking-wide font-bold text-white bg-blue-500 px-2 py-2 rounded-lg shadow-inner">
                Persyaratan</h1>
            <ul class="p-3 space-y-1 list-disc list-inside text-lg text-justify">
                <li>Laki-Laki / Perempuan dengan umur minimal 6 tahun
                    atau maximal 20 tahun</li>
                <li>Mengisi formulir pendaftaran secara offline ataupun via online dengan menghubungi WhatsApp :
                    <a href="https://wa.me/6289679479654" target="_blank" class="text-blue-500 underline">
                        089679479654
                    </a>
                </li>
                <li>Melunasi biaya pendaftaran dan spp pada bulan pertama secara tunai atau dengan transfer dengan
                    tujuan
                    <p class="ml-3 px-3 rounded-md font-bold bg-yellow-300 w-fit"> Rekening BSI : 7117245448 a.n
                        Fahmi Ramdani</p>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="mb-1 mt-10 w-full text-center text-3xl tracking-wide p-2 relative">
        Jadwal dan Biaya
        <span class="absolute bottom-0 left-1/4 w-1/2 border-b-4 border-blue-500"></span>
    </h1>

    <div class="flex flex-wrap justify-center my-10 gap-5">
        @foreach ($dataKelas as $kelas)
            <div class=" w-72 rounded-lg shadow-lg p-4 text-center">
                <div
                    class="text-2xl font-bold text-white mb-2 pb-1 tracking-wide  bg-blue-500 w-full text-center rounded-lg p-2">
                    {{ $kelas['nama'] }}
                </div>
                <div class="text-gray-900 mt-2 text-lg space-y-2 text-justify">
                    <p>Pukul : {{ $kelas['waktu'] }}</p>
                    <p>Hari : {{ $kelas['hari'] }}</p>
                    <p>Pendaftaran : Rp. {{ number_format($kelas['pendaftaran'], 0, ',', '.') }}</p>
                    <p>SPP : Rp. {{ number_format($kelas['spp'], 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <h1 class="mb-1 mt-10 w-full text-center text-3xl tracking-wide p-2 relative">
        Perlengkapan yang didapat
        <span class="absolute bottom-0 left-1/4 w-1/2 border-b-4 border-blue-500"></span>
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 my-10 justify-items-center">
        <div class="w-2/3 px-5 pt-5 rounded-lg shadow-md">
            <h1
                class=" mb-1 w-full text-center text-3xl tracking-wide font-bold text-white bg-blue-500 px-2 py-2 rounded-lg shadow-inner">
                Kelas Tahsin</h1>
            <ul class="p-3 space-y-1 list-disc list-inside text-lg ">
                <li>Kitab Iqro 1-6</li>
                <li>Buku BPIS</li>
                <li>Kartu Setoran</li>
                <li>Kartu SPP</li>
            </ul>
        </div>
        <div class="w-2/3 px-5 pt-5  rounded-lg shadow-md">
            <div
                class=" mb-1 w-full text-center text-3xl tracking-wide font-bold text-white bg-blue-500 px-2 py-2 rounded-lg shadow-inner">
                Kelas Tahfizh</div>
            <ul class="p-3 space-y-1 list-disc list-inside text-lg ">
                <li>AlQuran Juz 29 & 30</li>
                <li>Buku BPIS</li>
                <li>Kartu Setoran</li>
                <li>Kitab Fiqih dan Akhlaq</li>
                <li>Kartu SPP</li>
            </ul>
        </div>
    </div>
</div> --}}

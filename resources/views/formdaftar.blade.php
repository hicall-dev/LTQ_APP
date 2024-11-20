{{-- <!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white pb-4 px-4">
    <div class="max-w-4xl mx-auto  p-8 rounded-lg">
        <!-- Header -->
        <div class="flex justify-center items-center flex-row border-b-4">
            <div>
                <img src="{{ asset('/img/logo.png') }}" alt="" class="w-16 h-16 my-2">
            </div>
            <div class="text-center mx-3 px-3">
                <h1 class="text-2xl font-bold uppercase tracking-wide ">Lembaga Tahsin & Tahfizh Quran Terpadu
                    <br>Khoirunnasyien
                </h1>
            </div>
        </div>

        <!-- Header -->
        <div class="text-center my-6">
            <h1 class="text-xl font-bold uppercase">Formulir Pendaftaran SANTRI BARU</h1>
        </div>

        <div class="px-5">


            <!-- Data Santri -->
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Data Santri</h2>
                <table class="w-full text-left text-sm">
                    <tr>
                        <td class="py-1 px-4 border-b ">Nama</td>
                        <td class="py-1 px-4 border-b">{{ $data['nama_santri'] ?? '-' }}
                            <span class="font-bold">
                                @if (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Laki-laki')
                                    Bin
                                @else
                                    Binti
                                @endif
                            </span>
                            {{ $data['nama_ayah'] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">Jenis Kelamin</td>
                        <td class="py-1 px-4 border-b">{{ $data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b  w-60">Tempat Tanggal Lahir</td>
                        <td class="py-1 px-4 border-b">{{ $data['ttl_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">Alamat</td>
                        <td class="py-1 px-4 border-b">{{ $data['alamat_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">No. WhatsApp</td>
                        <td class="py-1 px-4 border-b">{{ $data['wa_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">Asal Sekolah</td>
                        <td class="py-1 px-4 border-b">{{ $data['asal_sekolah'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Data Wali -->
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Data Wali Santri</h2>
                <table class="w-full text-left text-sm">
                    <tr>
                        <td class="py-1 px-4 border-b ">Nama</td>
                        <td class="py-1 px-4 border-b">{{ $data['nama_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b  w-60">Tempat Tanggal Lahir</td>
                        <td class="py-1 px-4 border-b">{{ $data['ttl_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">Alamat</td>
                        <td class="py-1 px-4 border-b">{{ $data['alamat_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-4 border-b ">No. WhatsApp</td>
                        <td class="py-1 px-4 border-b">{{ $data['wa_wali'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Tanda Tangan Wali -->
        <div class="mt-12">
            <div class="border border-gray-300 p-2 rounded-lg">
                <p class="text-sm mb-4 text-justify">
                    Dengan ini, saya menyatakan bahwa data yang tertera di atas adalah benar. Saya dan anak didik saya
                    bersedia mengikuti peraturan yang berlaku di lembaga ini serta memahami bahwa apabila melanggar
                    peraturan, saya atau anak didik saya bersedia diberikan sanksi sesuai ketentuan yang berlaku.
                </p>
                <p class="text-sm mb-4">
                    Saya juga mengonfirmasi bahwa anak didik saya siap mengikuti jadwal yang telah ditentukan, yaitu
                    jadwal

                    <span class="font-bold">{{ $data['kelas'] ?? '....................' }}</span>.
                </p>

                <div class="mt-5 mr-5 text-right">
                    <p class="text-sm tracking-wider ">Palembang, {{ date('d-m-Y') }}</p>
                    <div class=" w-fit ml-auto text-center">
                        @if (isset($data['signature_data']))
                            <div class="flex justify-center">
                                <img src="{{ $data['signature_data'] }}" alt="Tanda Tangan" width="150"
                                    height="100">
                            </div>
                        @else
                            <p class="text-sm font-light my-10">*tanda tangan</p>
                        @endif
                        <p class="font-bold border-b mb-3 border-black">
                            {{ $data['nama_wali'] ?? '....................' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulir Pendaftaran</title>
    <style>
        table {
            /* width: 100%; */
            border-collapse: collapse;
            /* border: 1px solid black; */
            /* Menggabungkan border antara sel */
        }

        td {
            padding-left: 10px;
            padding-right: 10px;
        }

        .header-container {
            display: flex;
            align-items: center;
            padding-left: 25px;
            padding-right: 25px;
            padding-bottom: 10px;
            justify-content: center;
            margin-top: -20px;
            /* Menjaga gambar dan teks sejajar secara vertikal */
        }

        .header-container h2 {
            text-align: center;
            /* Ukuran font dapat disesuaikan */
        }

        .vertical-line {
            border-top: 2px solid black;
            /* Menambahkan garis vertikal */

            /* Tentukan tinggi garis sesuai kebutuhan */
        }

        .badan {
            padding-top: 10px;
            padding-left: 50px;
            padding-right: 50px;
            text-align: justify;
        }

        .nama_wali {
            border-bottom: 1px solid black;
        }

        .kelas{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header-container">
        <table>
            <tr>
                <td>
                    @if (isset($data['base64Image']))
                        <img src="{{ $data['base64Image'] }}" width="80" height="80" alt="Logo">
                    @endif
                </td>
                <td>
                    <h2>LEMBAGA TAHSIN & TAHFIZH QURAN TERPADU KHOIRUNNASYIEN</h2>
                </td>
            </tr>
        </table>
    </div>
    <div class="vertical-line"></div>
    <h2 style="text-align: center">Formulir Pendaftaran Santri Baru</h2>
    <div class="badan">
        <h3>Data Santri</h3>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data['nama_santri'] ?? '-' }}
                    <span>
                        @if (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'Laki-laki')
                            Bin
                        @else
                            Binti
                        @endif
                    </span>
                    {{ $data['nama_ayah'] ?? '-' }}
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $data['jenis_kelamin'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $data['ttl_santri'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data['alamat_santri'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. WhatsApp</td>
                <td>:</td>
                <td>{{ $data['wa_santri'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>:</td>
                <td>{{ $data['asal_sekolah'] ?? '-' }}</td>
            </tr>
        </table>


        <!-- Data Wali -->

        <h3>Data Wali Santri</h3>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data['nama_wali'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $data['ttl_wali'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data['alamat_wali'] ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. WhatsApp</td>
                <td>:</td>
                <td>{{ $data['wa_wali'] ?? '-' }}</td>
            </tr>
        </table>


        <div>
            <br>
            <br>
            <p>
                Dengan ini, saya menyatakan bahwa data yang tertera di atas adalah benar. Saya dan anak didik saya
                bersedia mengikuti peraturan yang berlaku di lembaga ini serta memahami bahwa apabila melanggar
                peraturan, saya atau anak didik saya bersedia diberikan sanksi sesuai ketentuan yang berlaku.
            </p>
            <p>
                Saya juga mengonfirmasi bahwa anak didik saya siap mengikuti jadwal yang telah ditentukan, yaitu
                jadwal

                <span class="kelas">{{ $data['kelas'] ?? '....................' }}</span>.
            </p>

            <div>
                <p>Palembang, {{ date('d-m-Y') }}</p>
                <div>
                    @if (isset($data['signature_data']))
                        <div>
                            <img src="{{ $data['signature_data'] }}" alt="Tanda Tangan" width="150" height="100">
                        </div>
                    @else
                        <p>*tanda tangan</p>
                    @endif
                    <span class="nama_wali">
                        {{ $data['nama_wali'] ?? '....................' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

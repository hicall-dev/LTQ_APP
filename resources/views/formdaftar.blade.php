<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white p-4">
    <div class="max-w-4xl mx-auto  p-8 rounded-lg">
        <!-- Header -->
        <div class="flex justify-center items-center flex-row border-b-4">
            <div>
                <img src="{{ asset('/img/logo.png') }}" alt="" class=" w-16 h-16 my-2">
            </div>
            <div class="text-center mx-3 px-3">
                <h1 class="text-2xl font-bold uppercase tracking-wide ">Lembaga Tahsin & Tahfizh Quran Terpadu
                    <br>Khoirunnasyien
                </h1>
            </div>
        </div>
        {{-- <div class="text-center mb-6">

            <h1 class="text-2xl font-bold uppercase">Lembaga Tahsin & Tahfidz Quran Terpadu
                <br>Khoirunnasyien
            </h1>
        </div> --}}
        <!-- Header -->
        <div class="text-center my-6">
            <h1 class="text-xl font-bold uppercase">Formulir Pendaftaran SANTRI BARU</h1>
            {{-- <p class="text-sm text-gray-600">Dibuat Tanggal {{ date('d-m-Y') }}</p> --}}
        </div>

        <div class="px-5">


            <!-- Data Santri -->
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Data Santri</h2>
                <table class="w-full text-left text-sm">
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Nama</th>
                        <td class="py-1 px-4 border-b">{{ $data['nama_santri'] ?? '-' }}
                            <span class="font-bold">
                                @if ($data['jenis_kelamin'] == 'Laki-laki')
                                    Bin
                                @else
                                    Binti
                                @endif
                                {{-- {{ $data['jenis_kelamin'] == 'laki-laki' ? 'Bin' : ($data['jenis_kelamin'] == 'perempuan' ? 'Binti' : '') }} --}}
                            </span>
                            {{ $data['nama_ayah'] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Jenis Kelamin</th>
                        <td class="py-1 px-4 border-b">{{ $data['jenis_kelamin'] ?? '-' }}</td>
                    </tr>
                    {{-- <tr>
                    <th class="py-1 px-4 border-b font-bold">Nama Ayah</th>
                    <td class="py-1 px-4 border-b">{{ $data['nama_ayah'] ?? '-' }}</td>
                </tr> --}}
                    <tr>
                        <th class="py-1 px-4 border-b font-bold w-60">Tempat Tanggal Lahir</th>
                        <td class="py-1 px-4 border-b">{{ $data['ttl_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Alamat</th>
                        <td class="py-1 px-4 border-b">{{ $data['alamat_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">No. WhatsApp</th>
                        <td class="py-1 px-4 border-b">{{ $data['wa_santri'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Asal Sekolah</th>
                        <td class="py-1 px-4 border-b">{{ $data['asal_sekolah'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Data Wali -->
            <div class="mb-6">
                <h2 class="text-lg font-bold mb-2">Data Wali Santri</h2>
                <table class="w-full text-left text-sm">
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Nama</th>
                        <td class="py-1 px-4 border-b">{{ $data['nama_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold w-60">Tempat Tanggal Lahir</th>
                        <td class="py-1 px-4 border-b">{{ $data['ttl_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">Alamat</th>
                        <td class="py-1 px-4 border-b">{{ $data['alamat_wali'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 px-4 border-b font-bold">No. WhatsApp</th>
                        <td class="py-1 px-4 border-b">{{ $data['wa_wali'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Tanda Tangan Wali -->
        <div class="mt-12">
            {{-- <h2 class="text-lg font-semibold text-gray-700 mb-4">Tanda Tangan Wali</h2> --}}
            <div class="border border-gray-300 p-2 rounded-lg">
                <p class="text-sm mb-4 text-justify">
                    Dengan ini, saya menyatakan bahwa data yang tertera di atas adalah benar. Saya dan anak didik saya
                    bersedia mengikuti peraturan yang berlaku di lembaga ini serta memahami bahwa apabila melanggar
                    peraturan, saya atau anak didik saya bersedia diberikan sanksi sesuai ketentuan yang berlaku.
                </p>
                <p class="text-sm mb-4">
                    Saya juga mengonfirmasi bahwa anak didik saya siap mengikuti jadwal yang telah ditentukan, yaitu
                    pada jadwal

                    <span class="font-bold">{{ $data['kelas'] }}</span>.
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
                        <p class="font-bold border-t border-black">{{ $data['nama_wali'] ?? '....................' }}
                        </p>
                    </div>
                    {{-- <p class="font-bold mt-2">{{ $data['nama_wali'] ?? '....................' }}</p> --}}
                </div>
            </div>
        </div>

        {{-- <!-- Footer -->
        <div class="text-right mt-6">
            <p class="text-sm text-gray-600">Formulir ini adalah dokumen resmi dari sistem.</p>
        </div> --}}
    </div>
</body>

</html>

{{-- @dd($data) --}}

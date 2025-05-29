<head>
    <title>
        {{ $title }}
    </title>
</head>
<x-layouthome>
    {{-- @dd($title) --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <div id="cek" class=" h-1/2">
        <h1 class="text-3xl font-bold text-center tracking-widest py-5 border-b-4 border-blue-500">
            {{ $title }}</h1>
        <form method="GET"
            action="{{ Request::path() == 'cek_spp' ? '/status_spp' : (Request::path() == 'cek_kelas' ? '/status_kelas' : '') }}">
            @csrf
            <div class="my-9 flex justify-center">
                <div
                    class=" w-1/2 rounded-md shadow-sm mr-2 ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600">
                    <input type="search" id="nis" name="nis" autocomplete="off"
                        class=" block w-full flex-auto border-0 bg-transparent py-3 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0  leading-6 rounded-md"
                        placeholder="Masukkan NIS Lengkap Santri">
                </div>
                <button type="submit"
                    class="inline-flex justify-center items-center rounded-md bg-blue-600 px-4  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class=" my-3 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </form>
        @if (session()->has('error'))
            <h1
                class=" mb-1 w-full text-center text-2xl tracking-wide font-bold text-white bg-red-500 px-2 py-2 rounded-lg shadow-inner">
                MAAF DATA SANTRI TIDAK DITEMUKAN, SEGERA HUBUNGI USTADZ</h1>
        @else
            @php
                $date = \Carbon\Carbon::now()->locale('id');
            @endphp
            @isset($santri)
                <div class="grid justify-center items-center">
                    <div class="w-fit px-2 py-5 rounded-lg shadow-md">
                        <h1
                            class="mb-1 w-full text-center text-sm md:text-lg tracking-wide font-bold text-white bg-blue-500 px-2 py-2 rounded-lg shadow-inner">
                            {{ Request::path() == 'status_spp' ? 'STATUS SPP' : (Request::path() == 'status_kelas' ? 'PERKEMBANGAN SANTRI' : '') }}
                        </h1>
                        <table class="table-auto w-full text-sm md:text-lg">
                            <tr>
                                <td class="whitespace-nowrap">Nama</td>
                                <td class="px-1">:</td>
                                <td class="">{{ $santri->nama }}</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap">NIS</td>
                                <td class="px-1">:</td>
                                <td class="">{{ $santri->nis }}</td>
                            </tr>
                            {{-- @if (Request::path() != 'status_spp')
                                <tr>
                                    <td class="whitespace-nowrap">TTL</td>
                                    <td class="px-1">:</td>
                                    <td class="">
                                        {{ $santri->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                            @endif --}}
                            <tr>
                                <td class="whitespace-nowrap">Kelas</td>
                                <td class="px-1">:</td>
                                <td>
                                    @if (strpos($santri->kelas, 'Tahsin') === false)
                                        Tahfidz
                                    @endif
                                    {{ $santri->kelas }}
                                </td>
                            </tr>
                            @if (Request::path() != 'status_spp')
                                <tr >
                                    <td class="whitespace-nowrap">Pengajar</td>
                                    <td class="px-1">:</td>
                                    <td class="">
                                        {{ $santri->pembimbing?->name ?? 'Belum ada data' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">Hafalan</td>
                                    <td class="px-1">:</td>
                                    <td class="">
                                        {{ $nilaiSekarang->hafalan ?? 'Belum ada data' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-5" colspan="3">Penilaian Bulan {{ $date->translatedFormat('F') }}
                                    </td>
                                </tr>

                                @php
                                    $nilaiList = [
                                        0 => 'Sangat Kurang',
                                        1 => 'Kurang',
                                        2 => 'Cukup',
                                        3 => 'Baik',
                                        4 => 'Sangat Baik',
                                    ];
                                @endphp
                                <tr>
                                    <td class="whitespace-nowrap">Progres </td>
                                    <td class="px-1">:</td>
                                    <td class="">
                                        {{ isset($nilaiSekarang->perkembangan) ? $nilaiList[$nilaiSekarang->perkembangan] : 'Belum ada data' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap">Akhlak</td>
                                    <td class="px-1">:</td>
                                    <td class="">
                                        {{ isset($nilaiSekarang->akhlak) ? $nilaiList[$nilaiSekarang->akhlak] : 'Belum ada data' }}
                                    </td>
                                </tr>
                            @endif
                            @if (Request::path() == 'status_spp')
                                <tr>
                                    <td>Status SPP {{ $date->translatedFormat('F') }}</td>
                                    <td class="px-1">:</td>
                                    <td>
                                        <div
                                            class="w-fit inline-flex justify-center items-center rounded-md px-2 font-semibold text-white shadow-sm {{ $santri->status_spp ? 'bg-green-500 ' : 'bg-red-500 ' }}">
                                            {{ $santri->status_spp ? 'Lunas' : 'Belum Lunas' }}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @if (Request::path() == 'status_kelas')
                                @if ($santri->kelas == 'Tahsin Awwal')
                                    <tr>
                                        <td>Materi Bacaan</td>
                                        <td class="px-1">:</td>
                                        <td>Iqro 1 s/d Iqro 3</td>
                                    </tr>
                                    <tr>
                                        <td>Materi Hafalan Bacaan Sholat</td>
                                        <td class="px-1">:</td>
                                        <td>Niat Wudhu s/d Bacaan Itidal (BPIS)</td>
                                    </tr>
                                @elseif ($santri->kelas == 'Tahsin Akhir')
                                    <tr>
                                        <td>Materi Bacaan</td>
                                        <td class="px-1">:</td>
                                        <td>Iqro 4 s/d Iqro 6</td>
                                    </tr>
                                    <tr>
                                        <td>Materi Hafalan Bacaan Sholat</td>
                                        <td class="px-1">:</td>
                                        <td>Qunut s/d Takhiyat Akhir (BPIS)</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Materi Hafalan AlQuran</td>
                                    <td class="px-1">:</td>
                                    <td>{{ $materi }}</td>
                                </tr>
                            @endif
                        </table>
                        {{-- <ul class="p-3 space-y-1 list-disc list-inside text-lg text-justify">
                        <li>Nama : {{ $santri->nama }}</li>
                        <li>NIS : {{ $santri->nis }}</li>
                        <li>Kelas : {{ $santri->kelas }}</li>
                        @if (Request::path() == 'status_spp')
                            <li>Status SPP : <div
                                    class="w-fit inline-flex justify-center items-center rounded-md px-2 font-semibold text-white shadow-sm {{ $santri->status_spp ? 'bg-green-500 ' : 'bg-red-500 ' }}">
                                    {{ $santri->status_spp ? 'Lunas' : 'Belum Lunas' }}
                                </div>
                            </li>
                        @endif
                        @if (Request::path() == 'status_kelas')
                            @if ($santri->kelas == 'Tahsin Awwal')
                                <li>Materi Bacaan : Iqro 4 s/d Iqro 6</li>
                                <li>Materi Hafalan Bacaan Sholat : Niat Wudhu s/d Bacaan Itidal (BPIS)</li>
                            @elseif ($santri->kelas == 'Tahsin Akhir')
                                <li>Materi Bacaan : Iqro1 s/d Iqro 3</li>
                                <li>Materi Hafalan Bacaan Sholat : Qunut s/d Takhiyat Akhir (BPIS)</li>
                            @endif
                            <li>Materi Hafalan AlQuran : {{ $materi }}</li>
                        @endif
                    </ul> --}}
                    </div>
                </div>
            @endisset
        @endif



    </div>

</x-layouthome>

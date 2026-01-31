<head>
    <title>
        {{ $title }}
    </title>
</head>
<x-layouthome>
    {{-- @dd($title) --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">

        <!-- Search Section -->
        <div class="w-full max-w-md space-y-8 mb-10">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ $title }}
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Masukkan Nomor Induk Santri (NIS) di bawah ini.
                </p>
            </div>

            <form method="GET"
                action="{{ Request::path() == 'cek_spp' ? '/status_spp' : (Request::path() == 'cek_kelas' ? '/status_kelas' : '') }}"
                class="mt-8">
                @csrf
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="search" name="nis" id="nis" autocomplete="off"
                        class="block w-full rounded-md border-0 py-3 pl-10 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 shadow-sm"
                        placeholder="Contoh: 12345678" required>
                    <button type="submit"
                        class="absolute inset-y-0 right-0 flex items-center px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-r-md font-semibold text-sm transition-colors duration-200">
                        Cari Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Result / Error Section -->
        @if (session()->has('error'))
            <div class="w-full max-w-md bg-white border-l-4 border-red-500 p-4 mb-8 rounded-r-md shadow-md animate-pulse">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Data Tidak Ditemukan</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Maaf, data santri dengan NIS tersebut tidak ditemukan. Silakan hubungi Ustadz/Admin.</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @php
                $date = \Carbon\Carbon::now()->locale('id');
                $bulanLalu = $date->copy()->subMonth();
            @endphp
            @isset($santri)
                <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100/50">

                    <!-- Card Header -->
                    <!-- <div class="bg-gradient-to-br from-blue-700 to-blue-500 px-8 py-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 opacity-10 transform translate-x-10 -translate-y-10">
                            <svg class="w-64 h-64 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white flex items-center gap-3 relative z-10">
                            {{ Request::path() == 'status_spp' ? 'STATUS SPP' : (Request::path() == 'status_kelas' ? 'RAPOR PERKEMBANGAN' : 'DATA SANTRI') }}
                        </h2>
                    </div> -->

                    <!-- Card Body -->
                    <div class="p-6 md:p-8 space-y-8">

                        <!-- Profile Header -->
                        <div class="flex flex-col md:flex-row items-center gap-6 pb-6 border-b border-gray-100">
                            <div
                                class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-100 to-white flex items-center justify-center text-blue-600 font-extrabold text-4xl border-[6px] border-blue-50 shadow-inner">
                                {{ substr($santri->nama, 0, 1) }}
                            </div>
                            <div class="text-center flex-1 space-y-2">
                                <h3 class="text-3xl font-bold text-slate-800 leading-none">
                                    {{ $santri->nama }}
                                </h3>

                                <div class="flex flex-col md:flex-row gap-2 justify-center items-center text-sm text-slate-500 font-medium">
                                    <span class="bg-slate-100 px-3 py-1 rounded-full text-slate-600 border border-slate-200">
                                        NIS:
                                        <span class="font-mono font-bold text-slate-800">
                                            {{ $santri->nis }}
                                        </span>
                                    </span>

                                    <span class="bg-blue-50 px-3 py-1 rounded-full text-blue-600 border border-blue-100">
                                        {{ $santri->kelas }}
                                        @if (strpos($santri->kelas, 'Tahsin') === false)
                                            (Tahfidz)
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if (Request::path() != 'status_spp')
                            <!-- Unified Academic Card -->
                            <div class="bg-slate-50/50 rounded-3xl p-6 border border-slate-100 shadow-sm">
                                
                                <!-- Header: Pengajar & Date -->
                                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                                     <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white rounded-xl shadow-sm border border-slate-100">
                                            <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pembimbing</p>
                                            <p class="text-lg font-bold text-slate-800">{{ $santri->pembimbing?->name ?? 'Belum ada data' }}</p>
                                        </div>
                                     </div>

                                     @php
                                        $tanggalTerakhir = isset($nilaiSekarang->created_at)
                                            ? $nilaiSekarang->created_at->translatedFormat('d F Y')
                                            : 'Belum Ada Penilaian';
                                    @endphp
                                    <div class="text-center md:text-right">
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Tanggal Penilaian
                                        </p>
                                        <div class="inline-flex items-center justify-center gap-1.5
                                            text-blue-600 font-medium bg-blue-50 px-3 py-1 rounded-lg mt-1
                                            border border-blue-100">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $tanggalTerakhir }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Grades & Materi Grid -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    
                                    <!-- Left: Report Cards (Perkembangan & Akhlak) -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                                        @php
                                            $grades = [
                                                0 => ['label' => 'Sangat Kurang', 'color' => 'from-red-50 to-white text-red-600 border-red-100 ring-red-100', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                                                1 => ['label' => 'Kurang', 'color' => 'from-orange-50 to-white text-orange-600 border-orange-100 ring-orange-100', 'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                                2 => ['label' => 'Cukup', 'color' => 'from-yellow-50 to-white text-yellow-600 border-yellow-100 ring-yellow-100', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                                3 => ['label' => 'Baik', 'color' => 'from-emerald-50 to-white text-emerald-600 border-emerald-100 ring-emerald-100', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                                4 => ['label' => 'Sangat Baik', 'color' => 'from-blue-50 to-white text-blue-600 border-blue-100 ring-blue-100', 'icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                            ];
                                        @endphp
                                        
                                        <!-- Card Perkembangan -->
                                        @php
                                            $pVal = $nilaiSekarang->perkembangan ?? null;
                                            $pGrade = isset($pVal) ? $grades[$pVal] : null;
                                        @endphp
                                        <div class="relative group p-5 rounded-2xl bg-gradient-to-br {{ $pGrade ? $pGrade['color'] : 'from-gray-50 to-white text-gray-400 border-gray-100' }} border shadow-sm hover:shadow-md transition-all duration-300">
                                            <div class="absolute top-4 right-4 opacity-20">
                                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                </svg>
                                            </div>
                                            <p class="text-xs font-bold uppercase tracking-wider opacity-70 mb-2">Perkembangan</p>
                                            <p class="text-xl font-extrabold">{{ $pGrade['label'] ?? 'Belum ada data' }}</p>
                                        </div>

                                        <!-- Card Akhlak -->
                                        @php
                                            $aVal = $nilaiSekarang->akhlak ?? null;
                                            $aGrade = isset($aVal) ? $grades[$aVal] : null;
                                        @endphp
                                        <div class="relative group p-5 rounded-2xl bg-gradient-to-br {{ $aGrade ? $aGrade['color'] : 'from-gray-50 to-white text-gray-400 border-gray-100' }} border shadow-sm hover:shadow-md transition-all duration-300">
                                             <div class="absolute top-4 right-4 opacity-20">
                                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs font-bold uppercase tracking-wider opacity-70 mb-2">Akhlak</p>
                                            <p class="text-xl font-extrabold">{{ $aGrade['label'] ?? 'Belum ada data' }}</p>
                                        </div>
                                    </div>

                                    <!-- Right: Materi Pembelajaran -->
                                    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col justify-center">
                                        <div class="mb-4 pb-3 border-b border-slate-50">
                                             <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                                                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                Materi Pembelajaran
                                             </h4>
                                        </div>

                                        @if (Request::path() == 'status_kelas')
                                            <ul class="space-y-4">
                                                @if ($santri->kelas == 'Tahsin Awwal')
                                                    <li class="group">
                                                        <span class="block text-xs font-semibold text-slate-400 mb-1">Materi Bacaan</span>
                                                        <span class="block font-medium text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 group-hover:border-blue-200 transition-colors">Iqro 1 s/d Iqro 3</span>
                                                    </li>
                                                    <li class="group">
                                                        <span class="block text-xs font-semibold text-slate-400 mb-1">Hafalan Sholat</span>
                                                        <span class="block font-medium text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 group-hover:border-blue-200 transition-colors">Niat Wudhu s/d Bacaan Itidal (BPIS)</span>
                                                    </li>
                                                @elseif ($santri->kelas == 'Tahsin Akhir')
                                                     <li class="group">
                                                        <span class="block text-xs font-semibold text-slate-400 mb-1">Materi Bacaan</span>
                                                        <span class="block font-medium text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 group-hover:border-blue-200 transition-colors">Iqro 4 s/d Iqro 6</span>
                                                    </li>
                                                     <li class="group">
                                                        <span class="block text-xs font-semibold text-slate-400 mb-1">Hafalan Sholat</span>
                                                        <span class="block font-medium text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 group-hover:border-blue-200 transition-colors">Qunut s/d Takhiyat Akhir (BPIS)</span>
                                                    </li>
                                                @endif
                                                <li class="group">
                                                    <span class="block text-xs font-semibold text-slate-400 mb-1">Hafalan Al-Qur'an</span>
                                                    <div class="font-medium text-slate-700 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 group-hover:border-blue-200 transition-colors flex justify-between items-center">
                                                        <span>{{ $nilaiSekarang->hafalan ?? 'Belum ada data' }}</span>
                                                        @if(isset($nilaiSekarang->hafalan))
                                                            <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        @else
                                            <div class="text-center py-6 text-slate-400 italic text-sm">
                                                Pilih menu "Perkembangan Santri" untuk melihat detail materi.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (Request::path() == 'status_spp')
                            <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-sm">
                                <div class="text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Status Pembayaran SPP</p>
                                    
                                    <div class="flex flex-col items-center justify-center gap-6">
                                        <div class="relative">
                                            <div class="w-24 h-24 rounded-full flex items-center justify-center {{ $santri->status_spp ? 'bg-green-50 text-green-500' : 'bg-red-50 text-red-500' }}">
                                                @if($santri->status_spp)
                                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @else
                                                     <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @endif
                                            </div>
                                            <!-- Optional pulse effect for unpaid -->
                                            @if(!$santri->status_spp)
                                                <div class="absolute inset-0 rounded-full bg-red-400 opacity-20 animate-ping"></div>
                                            @endif
                                        </div>

                                        <div class="space-y-1">
                                            <h3 class="text-3xl font-extrabold {{ $santri->status_spp ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $santri->status_spp ? 'LUNAS' : 'BELUM LUNAS' }}
                                            </h3>
                                            <p class="text-slate-500 font-medium text-lg">Periode: {{ $date->translatedFormat('F Y') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Helper Message -->
                                    <div class="mt-8 pt-6 border-t border-slate-50">
                                        @if($santri->status_spp)
                                            <p class="text-sm text-green-700 bg-green-50 inline-block px-4 py-2 rounded-full font-medium">
                                                Terima kasih atas pembayaran tepat waktu.
                                            </p>
                                        @else
                                            <p class="text-sm text-red-700 bg-red-50 inline-block px-4 py-2 rounded-full font-medium">
                                               Mohon segera melakukan pembayaran.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (Request::path() != 'status_spp' && isset($santri->pembimbing) && !empty($santri->pembimbing->phone))
                            @php
                                $pembimbingName = $santri->pembimbing->name;
                                $santriName = $santri->nama;
                                $waMessage = "Assalamu'alaikum $pembimbingName, saya wali $santriName ingin.....";
                                $waMessageEncoded = urlencode($waMessage);
                                $pembimbingPhone = $santri->pembimbing->phone;
                                
                                if ($pembimbingPhone && $pembimbingPhone[0] == '0') {
                                    $pembimbingPhone = '62' . substr($pembimbingPhone, 1);
                                }
                            @endphp
                            
                            <div class="flex justify-center pt-8 border-t border-slate-100 mt-2">
                                <a href="https://wa.me/{{ $pembimbingPhone }}?text={{ $waMessageEncoded }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-sm font-bold rounded-xl bg-green-500 text-white px-6 py-3 hover:bg-green-600 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <x-icons.whatsapp class="w-5 h-5" />
                                    Konsultasi dengan Pembimbing
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @endisset
        @endif
    </div>
</x-layouthome>

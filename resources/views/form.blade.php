<x-layoutDB>

    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('createSuccess'))
        <div id="alert-0"
            class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium pl-3">Pemberitahuan </span> {{ session('createSuccess') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-0" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @error('nis')
        <div id="alert-1"
            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium pl-3">Pemberitahuan </span>NIS sudah terdaftar
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @enderror

    <div class=" my-9 flex">
        <h1 class=" mb-1 text-5xl tracking-tight font-bold text-gray-900">{{ $judul }}</h1>
    </div>

    <form action="/dashboard/santri{{ isset($santri) ? '/' . $santri->nis : '' }}" method="POST">
        @if (isset($santri))
            @method('put')
        @endif
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-3">
                        <label for="nama" class="block font-medium leading-6 text-gray-900">Nama Lengkap</label>
                        <div class="mt-2">
                            <input type="text" name="nama" id="nama"
                                value="{{ isset($santri) ? $santri->nama : '' }}"
                                class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6"
                                required="">
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label for="nis" class="block font-medium leading-6 text-gray-900">
                            NIS
                            <div class="mt-2">
                                <input type="number" name="nis" id="nis"
                                    value="{{ isset($santri) ? $santri->nis : old('nis') }}"
                                    class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 leading-6 peer @error('nis') border-red-500 @enderror"
                                    required>
                            </div>
                        </label>

                    </div>
                    <div class="col-span-3">
                        <label for="tempat_lahir" class="block font-medium leading-6 text-gray-900">Tempat Lahir</label>
                        <div class="mt-2">
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                value="{{ isset($santri) ? $santri->tempat_lahir : '' }}"
                                class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6"
                                required="">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="tanggal_lahir" class="block  font-medium leading-6 text-gray-900">Tanggal
                            Lahir</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ isset($santri) ? $santri->tanggal_lahir : '' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6"
                                onfocus="this.showPicker && this.showPicker()">
                        </div>
                    </div>

                    @php
                        $kelasList = [
                            'Tahsin Awwal',
                            'Tahsin Akhir',
                            'Mutawassith',
                            'Pra Takhossus Awwal',
                            'Pra Takhossus Akhir',
                            'Takhossus Awwal',
                            'Takhossus Tsani',
                            'Takhossus Tsalits',
                            'Takhossus Robi',
                            'Takhossus Khomis',
                            'Takhossus Akhir',
                        ];
                    @endphp
                    <div class="col-span-3">
                        <label for="kelas" class="block  font-medium leading-6 text-gray-900">Kelas</label>
                        <div class="mt-2">
                            <select id="kelas" name="kelas"
                                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6"
                                required="">
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas }}"
                                        {{ isset($santri) && $santri->kelas == $kelas ? 'selected' : 'Tahsin Awwal' }}>
                                        {{ $kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if (empty($santri))
                        @php
                            $sppList = [0, 1, 2];
                        @endphp
                        <div class="col-span-3">
                            <label for="spp" class="block  font-medium leading-6 text-gray-900">Status
                                SPP</label>
                            <div class="mt-2">
                                <select id="status_spp" name="status_spp"
                                    class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 leading-6"
                                    required="">
                                    @foreach ($sppList as $status_spp)
                                        <option value="{{ $status_spp }}"
                                            {{ isset($santri) && $santri->status_spp == $status_spp ? 'selected' : '0' }}>
                                            @if ($status_spp == 0)
                                                Belum Lunas
                                            @elseif ($status_spp == 1)
                                                Lunas
                                            @elseif ($status_spp == 2)
                                                Gratis
                                            @endif
                                        </option>
                                    @endforeach
                                    {{-- <option value="1" {{ isset($santri) && $santri->status_spp ? 'selected' : '' }}>
                                    Lunas</option>
                                <option value="0" {{ isset($santri) && !$santri->status_spp ? 'selected' : '' }}>
                                    Belum Lunas</option> --}}
                                </select>
                            </div>
                        </div>
                    @endif
                    @php
                        $golongan_list = ['Putra Sore', 'Putra Malam', 'Putri Sore', 'Putri Pagi'];
                    @endphp
                    <div class="col-span-3">
                        <label for="golongan" class="block  font-medium leading-6 text-gray-900">Golongan</label>
                        <div class="mt-2">
                            <select id="golongan" name="golongan"
                                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 leading-6"
                                required="">
                                @foreach ($golongan_list as $golongan)
                                    <option value="{{ $golongan }}"
                                        {{ isset($santri) && $santri->golongan == $golongan ? 'selected' : 'Putra Sore' }}>
                                        {{ $golongan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-span-3">
                        {{-- <label for="operator_id" class="block font-medium leading-6 text-gray-900">Operator :
                            {{ isset($user) ? $user->name : '' }}</label>
                        <div class="mt-2"> --}}
                        <input type="hidden" name="operator_id" id="operator_id" value="{{ auth()->user()->id }}"
                            class="block px-3 w-fit rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @isset($santri)
                <div>
                    @if ($santri->status_spp != 2)
                        <h1 class="mb-5 text-md tracking-tight font-bold text-gray-900">Riwayat Pembayaran SPP</h1>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 text-sm text-gray-800">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-2 py-2 text-center">Tahun</th>
                                        @php
                                            $bulanList = [
                                                'Jan',
                                                'Feb',
                                                'Mar',
                                                'Apr',
                                                'Mei',
                                                'Jun',
                                                'Jul',
                                                'Agu',
                                                'Sep',
                                                'Okt',
                                                'Nov',
                                                'Des',
                                            ];
                                        @endphp
                                        @foreach ($bulanList as $bulan)
                                            <th class="border px-2 py-2 text-center">{{ $bulan }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $grouped = $santri->payments->groupBy('tahun');
                                    @endphp
                                    @foreach ($grouped as $tahun => $payments)
                                        <tr>
                                            <td class="border px-2 py-2 text-center font-semibold">{{ $tahun }}
                                            </td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @php
                                                    $payment = $payments->firstWhere('bulan', $i);
                                                @endphp
                                                <td class="border px-2 py-2 text-center">
                                                    @if ($payment)
                                                        @if ($payment->status == 1)
                                                            ✅
                                                        @elseif ($payment->status == 0)
                                                            ❌
                                                        @elseif ($payment->status == 2)
                                                            🆓
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-10 space-y-4">
                            <label class="block font-medium leading-6 text-gray-900">Pembayaran</label>

                            <div id="dropdown-container" class="space-y-2">
                                <!-- Baris pertama -->
                                <div class="grid grid-cols-1 sm:grid-cols-7 gap-x-4 items-center">
                                    @php
                                        $bulanIndonesia = [
                                            'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember',
                                        ];
                                    @endphp

                                    <div class="col-span-2 my-2">
                                        <select name="bulan[]"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                                            <option value="">-- Bulan --</option>
                                            @foreach (range(1, 12) as $bln)
                                                <option value="{{ $bln }}">
                                                    {{ $bulanIndonesia[$bln - 1] }}
                                                    <!-- Menampilkan nama bulan dalam bahasa Indonesia -->
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-2 my-2">
                                        <select name="tahun[]"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                                            <option value="">-- Tahun --</option>
                                            @foreach (range(date('Y'), date('Y') + 5) as $thn)
                                                <option value="{{ $thn }}">{{ $thn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        $sppList = [0, 1];
                                    @endphp
                                    <div class="col-span-2 my-2">
                                        <select name="status[]"
                                            class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                                            <option value="">-- Status --</option>
                                            @foreach ($sppList as $status_spp)
                                                <option value="{{ $status_spp }}">
                                                    @if ($status_spp == 0)
                                                        Belum Lunas
                                                    @elseif ($status_spp == 1)
                                                        Lunas
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex">
                                        <div class="w-full mx-2 my-2">
                                            <button type="button" onclick="tambahDropdown()"
                                                class="rounded-md bg-green-500 w-full px-3 py-2 text-white font-semibold shadow-sm hover:bg-green-400">
                                                +
                                            </button>

                                        </div>
                                        <div class="w-full mx-2 my-2">
                                            <button type="button" onclick="resetDropdown()"
                                                class="rounded-md bg-red-500 w-full px-3 py-2 text-white font-semibold shadow-sm hover:bg-red-400">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @else
                        <h1 class="text-sm text-gray-500 italic mt-4">Santri ini bebas dari kewajiban pembayaran SPP.
                        </h1>
                    @endif

                </div>
            @endisset



        </div>
        <div class="mt-2 flex items-center justify-end gap-x-6">
            <a href="/dashboard/santri"
                class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-5 py-2  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 text-sm leading-6">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="-ml-0.5 mr-1.5 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit"
                class=" text-sm  leading-6 text-white mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-green-500 px-3 py-2  font-semibold  shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="-ml-0.5 mr-1.5 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                Simpan
            </button>
        </div>
        </div>

    </form>
    <script>
        function tambahDropdown() {
            const container = document.getElementById('dropdown-container');

            // Ambil bulan, tahun dan status pembayaran terakhir yang ada
            const allBulan = container.querySelectorAll('select[name="bulan[]"]');
            const allTahun = container.querySelectorAll('select[name="tahun[]"]');
            const allStatus = container.querySelectorAll('select[name="status_spp[]"]');

            const lastBulan = allBulan[allBulan.length - 1]?.value || '';
            const lastTahun = allTahun[allTahun.length - 1]?.value || '';
            const lastStatus = allStatus[allStatus.length - 1]?.value || '';

            // Array bulan dalam bahasa Indonesia
            const bulanIndonesia = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const bulanOptions = bulanIndonesia.map((bulan, index) => {
                return `<option value="${index + 1}" ${lastBulan == (index + 1) ? 'selected' : ''}>${bulan}</option>`;
            }).join('');

            const tahunOptions = `
            @foreach (range(date('Y'), date('Y') + 5) as $thn)
                <option value="{{ $thn }}">{{ $thn }}</option>
            @endforeach
        `;

            const statusOptions = `
            <option value="0" ${lastStatus == 0 ? 'selected' : ''}>Belum Lunas</option>
            <option value="1" ${lastStatus == 1 ? 'selected' : ''}>Lunas</option>
        `;

            const row = document.createElement('div');
            row.className = 'grid grid-cols-1 sm:grid-cols-7 gap-x-4 items-center';

            row.innerHTML = `
            <div class="col-span-2 my-2">
                <select name="bulan[]" class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                    ${bulanOptions}
                </select>
            </div>
            <div class="col-span-2 my-2">
                <select name="tahun[]" class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                    ${tahunOptions}
                </select>
            </div>
            <div class="col-span-2 my-2">
                <select name="status[]" class="w-full rounded-md border-0 py-1.5 text-gray-900 ring-1 ring-gray-300 focus:ring-indigo-600">
                    ${statusOptions}
                </select>
            </div>
            <div class="flex">
                <div class="w-full mx-2 my-2">
                    <button type="button" onclick="tambahDropdown()"
                        class="rounded-md w-full bg-green-500 px-3 py-2 text-white font-semibold shadow-sm hover:bg-green-400">
                        +
                    </button>
                </div>
                <div class="w-full mx-2 my-2">
                    <button type="button" onclick="hapusDropdown(this)"
                        class="rounded-md w-full bg-red-500 px-3 py-2 text-white font-semibold shadow-sm hover:bg-red-400">
                        -
                    </button>
                </div>
            </div>
        `;

            container.appendChild(row);

            // Setelah ditambahkan, set nilai default sesuai baris sebelumnya
            setTimeout(() => {
                const bulanSelects = row.querySelectorAll('select[name="bulan[]"]');
                const tahunSelects = row.querySelectorAll('select[name="tahun[]"]');
                const statusSelects = row.querySelectorAll('select[name="status_spp[]"]');

                if (bulanSelects[0] && lastBulan) bulanSelects[0].value = lastBulan;
                if (tahunSelects[0] && lastTahun) tahunSelects[0].value = lastTahun;
                if (statusSelects[0] && lastStatus) statusSelects[0].value = lastStatus;
            }, 0);
        }

        function hapusDropdown(button) {
            button.closest('.grid').remove();
        }

        function resetDropdown() {
            const container = document.getElementById('dropdown-container');
            const allRows = container.querySelectorAll('.grid');

            // Sisakan hanya baris pertama, hapus lainnya
            allRows.forEach((row, index) => {
                if (index === 0) {
                    // Kosongkan nilai-nilai dropdown di baris pertama
                    const selects = row.querySelectorAll('select');
                    selects.forEach(select => {
                        select.value = '';
                    });
                } else {
                    // Hapus baris tambahan
                    row.remove();
                }
            });
        }
    </script>





</x-layoutDB>
{{-- <x-footerdb></x-footerdb> --}}

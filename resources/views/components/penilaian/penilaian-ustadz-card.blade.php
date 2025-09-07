<div class="rounded-2xl bg-white p-5 shadow-md ring-1 ring-slate-100 hover:shadow-lg transition">
    @php
        $totalSantriBelumDinilai = count($result->santris);
    @endphp
    <div class="flex items-start justify-between gap-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-900">{{ $result->ustadz_name }}</h3>
            <p class="text-sm text-slate-500 mt-0.5">Pembimbing</p>
        </div>

        @php
            $ratio = $totalSantriBelumDinilai / $result->total_santri;

            if ($ratio >= 0.8) {
                $badgeClass = 'bg-red-50 text-red-700';
                $label = 'Yahdik Alfa Marrah';
            } elseif ($ratio >= 0.01) {
                $badgeClass = 'bg-yellow-50 text-yellow-700';
                $label = 'Dikit Lagi';
            } else {
                $badgeClass = 'bg-green-50 text-green-700';
                $label = 'Alhamdulillah';
            }
        @endphp

        <span class="text-sm text-center px-5 py-3 rounded-full font-semibold {{ $badgeClass }}">
            {{ $label }}
        </span>
    </div>

    <div class="mt-5 mb-3 flex items-center gap-2">

        @if ($ratio == 0)
            <span class="h-2 w-2 rounded-full bg-green-500"></span>
            <p class="text-slate-700 font-medium">Semua santri sudah dinilai</p>
        @else
            <span class="h-2 w-2 rounded-full bg-red-500"></span>
            <p class="text-slate-700 font-medium">{{ $totalSantriBelumDinilai }} dari
                {{ $result->total_santri }} santri belum dinilai</p>
        @endif
    </div>

    @if ($ratio != 0)
        @php
            $message = urlencode(\App\Helpers\WhatsappHelper::messageSantri($result->ustadz_name, $result->santris));
            $phone = $result->phone;
            if ($phone && $phone[0] == '0') {
                $phone = str_replace('0', '62', $phone);
            }
        @endphp
        <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
            class="mt-4 inline-flex items-center gap-2 text-sm font-medium rounded-xl bg-green-500 text-white px-3 py-2 hover:bg-green-600 transition">
            <x-icons.whatsapp class="h-4 w-4" />
            Ingatkan via WhatsApp
        </a>
    @endif
</div>

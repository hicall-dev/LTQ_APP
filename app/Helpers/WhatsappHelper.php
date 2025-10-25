<?php

namespace App\Helpers;

class WhatsappHelper
{
    public static function messageSantri(string $ustadz, array $santri)
    {
        $header = "Assalamu'alaikum, $ustadz. Sekedar mengingatkan berikut santri-santri yang belum diberikan penilaian:";
        $listSantri = "";
        $currentYear = now()->year;

        foreach ($santri as $i => $s) {
            foreach ($s->belum_dinilai as $blm) {
                $no = $i + 1;
                $monthName = config('bulan.' . $blm);
                $listSantri .= "{$no}. {$s->name} ({$s->nis}) - {$monthName} {$currentYear} \n";
            }
        }
        return $header . "\n\n" . $listSantri;
    }

    public static function messageWaliSantri(string $namaSantri, ?string $bulan, ?string $tahun)
    {
        $bulan = $bulan ?? now()->month;
        $tahun = $tahun ?? now()->year;

        $namaBulan = config('bulan.' . $bulan);
        $message = <<<MSG
            Assalamualaikum warohmatullahi wabarokatuh

            Sehubungan akan berakhirnya bulan $namaBulan $tahun

            *Kami hanya mengingatkan*

            Menurut catatan bendahara lembaga kami, anak Bapak/Ibu $namaSantri belum melunasi SPP pada bulan $namaBulan $tahun

            Mohon kerjasamanya, tunggakan tersebut segera diselesaikan.

            Atas kerjasamanya, terima kasih

            #Mohon koreksi bila data kami salah
            MSG;
        return $message;
    }
}

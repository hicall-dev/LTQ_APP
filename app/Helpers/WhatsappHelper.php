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
}

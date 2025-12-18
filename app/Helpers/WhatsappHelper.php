<?php

namespace App\Helpers;

class WhatsappHelper
{
    public static function messageSantri(string $ustadz, array $santri)
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $namaBulan = config('bulan.' . $currentMonth);
        $header = "Assalamu'alaikum, $ustadz. Sekedar mengingatkan berikut santri-santri yang belum diberikan penilaian di bulan $namaBulan $currentYear :";
        $listSantri = "";

        foreach ($santri as $i => $s) {
            $no = $i + 1;
            $listSantri .= "{$no}. {$s->name} ({$s->nis}) \n";
        }
        return $header . "\n\n" . $listSantri;
    }

    public static function messageWaliSantri(string $namaSantri, string $nisSantri, ?string $bulan, ?string $tahun)
    {
        $bulan = $bulan ?? now()->month;
        $tahun = $tahun ?? now()->year;

        $namaBulan = config('bulan.' . $bulan);
        $message = <<<MSG
            Assalamualaikum warohmatullahi wabarokatuh

            Sehubungan akan berakhirnya bulan $namaBulan $tahun

            *Kami hanya mengingatkan..!*

            Menurut catatan bendahara lembaga kami, bahwa anak Bapak/Ibu:
            Nama: $namaSantri
            NIS: $nisSantri

            belum melunasi SPP $namaBulan $tahun

            Silahkan cek spp anak di website resmi lembaga :
            https://ltq-khoirunnasyien.com/cek_spp#cek

            Mohon kerjasamanya, tunggakan tersebut agar segera diselesaikan.

            Pembayaran bisa via transfer : Rek Bank BSI 7117245448 AN : Fahmi Ramdani

            Atas kerjasamanya, terima kasih

            #Mohon koreksi bila data kami salah
            MSG;
        return $message;
    }
}

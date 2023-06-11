<?php

namespace App\Helpers;

use Carbon\Carbon;

class FedHelper {
    public static function checkBatasWaktuPengisian($tahunAjaran)
    {
        $tahunAwal = '';
        $tahunAkhir = '';

        if (strpos($tahunAjaran, '/') !== false) {
            list($tahunAwal, $tahunAkhir) = explode('/', $tahunAjaran);
        }

        if ($tahunAwal !== '' && $tahunAkhir !== '') {
            $waktuSekarang = Carbon::now();
            $bulanSekarang = $waktuSekarang->month;
            $tahunSekarang = $waktuSekarang->year;
            $batasWaktuPengisian = null;

            if (($tahunSekarang >= (int) $tahunAwal && $tahunSekarang <= (int) $tahunAkhir) &&
                ($bulanSekarang >= 9 && $bulanSekarang <= 12) ||
                ($bulanSekarang >= 1 && $bulanSekarang <= 1))
            {
                $batasWaktuPengisian = Carbon::create((int) $tahunAkhir, 1, 31, 23, 59, 59);
            } elseif ($bulanSekarang >= 3 && $bulanSekarang <= 6) {
                $batasWaktuPengisian = Carbon::create((int) $tahunAkhir, 6, 30, 23, 59, 59);
            }

            if ($waktuSekarang <= $batasWaktuPengisian) {
                return true;
            }
        }

        return false;
    }

    public static function formatWorkingTime($dateRange)
    {
        // dd($dateRange);
        if (strpos($dateRange, ' - ') !== false) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $dates[0]);
            $endDate = Carbon::createFromFormat('d/m/Y', $dates[1]);

            $startDateFormatted = $startDate->format('d M Y');
            $endDateFormatted = $endDate->format('d M Y');

            echo $startDateFormatted . ' - ' . $endDateFormatted;
        } else {
            echo 'Format tanggal tidak sesuai.';
        }
    }
}

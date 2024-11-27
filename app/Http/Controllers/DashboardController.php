<?php

namespace App\Http\Controllers;

use App\Models\HasilSuara;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function index()
{
    // Mengambil total suara QuickCount
    $totalQuickCountPaslon1 = HasilSuara::where('Status', "QuickCount")->sum("paslon1");
    $totalQuickCountKotakKosong = HasilSuara::where('Status', "QuickCount")->sum("kotak_kosong");
    $totalQuickCountTidakSah = HasilSuara::where('Status', "QuickCount")->sum("suara_tidak_sah");

    // Total suara QuickCount
    $totalQuickCount = $totalQuickCountPaslon1 + $totalQuickCountKotakKosong + $totalQuickCountTidakSah;

    // Menghitung persentase QuickCount
    $persentaseQuickCountPaslon1 = ($totalQuickCountPaslon1 / $totalQuickCount) * 100;
    $persentaseQuickCountKotakKosong = ($totalQuickCountKotakKosong / $totalQuickCount) * 100;
    $persentaseQuickCountTidakSah = ($totalQuickCountTidakSah / $totalQuickCount) * 100;

    // Total suara RealCount
    $totalRealCountPaslon1 = HasilSuara::where('Status', "RealCount")->sum("paslon1");
    $totalRealCountKosong = HasilSuara::where('Status', "RealCount")->sum("kotak_kosong");
    $totalRealCountTidakSah = HasilSuara::where('Status', "RealCount")->sum("suara_tidak_sah");

    // Total suara RealCount
    $totalRealCount = $totalRealCountPaslon1 + $totalRealCountKosong + $totalRealCountTidakSah;

    // Mengambil total TPS yang sudah masuk suara
    $totalTpsMasuk = HasilSuara::where('Status', "QuickCount")->count();
    $totalSuaraMaksimal = 400; // Total maksimal suara

    // Menghitung persentase suara yang masuk
    $persentaseSuara = ($totalTpsMasuk / $totalSuaraMaksimal) * 100;

    // Data untuk per Kecamatan
    $totalQuickCountPerTps = Kecamatan::with('kelurahan.tps.hasilSuara')
        ->get()
        ->mapWithKeys(function ($kecamatan) {
            $totals = $kecamatan->kelurahan->flatMap->tps->flatMap->hasilSuara->where('Status', 'QuickCount');
            return [
                $kecamatan->nama => [
                    'total_paslon1' => $totals->sum('paslon1'),
                    'kotak_kosong' => $totals->sum('kotak_kosong'),
                    'total_tidak_sah' => $totals->sum('suara_tidak_sah'),
                ],
            ];
        });

    // Data untuk RealCount per Kecamatan
    $totalRealCountPerTps = Kecamatan::with('kelurahan.tps.hasilSuara')
        ->get()
        ->mapWithKeys(function ($kecamatan) {
            $totals = $kecamatan->kelurahan->flatMap->tps->flatMap->hasilSuara->where('Status', 'RealCount');
            return [
                $kecamatan->nama => [
                    'total_paslon1' => $totals->sum('paslon1'),
                    'kotak_kosong' => $totals->sum('kotak_kosong'),
                    'total_tidak_sah' => $totals->sum('suara_tidak_sah'),
                ],
            ];
        });

    // Mengembalikan data ke view
    return view('Dashboards.index', [
        "title" => "Dashboard",
        "totalQuickCountPaslon1" => $totalQuickCountPaslon1,
        "totalQuickCountKotakKosong" => $totalQuickCountKotakKosong,
        "totalQuickCountTidakSah" => $totalQuickCountTidakSah,
        "totalQuickCount" => $totalQuickCount,
        "persentaseQuickCountPaslon1" => $persentaseQuickCountPaslon1,
        "persentaseQuickCountKotakKosong" => $persentaseQuickCountKotakKosong,
        "persentaseQuickCountTidakSah" => $persentaseQuickCountTidakSah,
        "totalRealCountPaslon1" => $totalRealCountPaslon1,
        "totalRealCountKosong" => $totalRealCountKosong,
        "totalRealCountTidakSah" => $totalRealCountTidakSah,
        "totalRealCount" => $totalRealCount,
        "totalQuickCountPerTps" => $totalQuickCountPerTps,
        "totalRealCountPerTps" => $totalRealCountPerTps,
        "totalTpsMasuk" => $totalTpsMasuk,
        "totalSuaraMaksimal" => $totalSuaraMaksimal,
        "persentaseSuara" => $persentaseSuara
    ]);
}

}

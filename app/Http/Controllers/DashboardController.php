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
        $totalQuickCountPaslon1 = HasilSuara::where('Status', "QuickCount")->sum("paslon1");
        $totalQuickCountKotakKosong = HasilSuara::where('Status', "QuickCount")->sum("kotak_kosong");
        $totalQuickCountTidakSah = HasilSuara::where('Status', "QuickCount")->sum("suara_tidak_sah");
        $totalQuickCount = $totalQuickCountTidakSah  + $totalQuickCountKotakKosong + $totalQuickCountPaslon1;
        $totalRealCountPaslon1 = HasilSuara::where('Status', "RealCount")->sum("paslon1");
        $totalRealCountKosong = HasilSuara::where('Status', "RealCount")->sum("kotak_kosong");
        $totalRealCountTidakSah = HasilSuara::where('Status', "RealCount")->sum("suara_tidak_sah");
        $totalRealCount = $totalRealCountTidakSah + $totalRealCountKosong + $totalRealCountPaslon1;

        $totalTpsMasuk = HasilSuara::where('Status', "QuickCount")->get()->count();
        $totalSuaraMaksimal = 400; // Total suara maksimal
        $persentaseSuara = ($totalTpsMasuk / $totalSuaraMaksimal) * 100;

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
        return view('Dashboards.index', [
            "title" => "Dashboard",
            "totalQuickCountPaslon1" => $totalQuickCountPaslon1,
            "totalQuickCountKotakKosong" => $totalQuickCountKotakKosong,
            "totalQuickCountTidakSah" => $totalQuickCountTidakSah,
            "totalQuickCount" => $totalQuickCount,
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

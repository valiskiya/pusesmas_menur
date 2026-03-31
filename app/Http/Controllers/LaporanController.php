<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Ambil Statistik (Ini untuk Grafik/Bar Chart)
        $stats = Poli::withCount(['antrian' => function($query) use ($today){
            $query->whereDate('tanggal', $today);
        }])->get();

        // 2. Ambil Data Detail Laporan (INI YANG KEMARIN HILANG/BELUM ADA)
        // Kita ambil semua antrian hari ini + data pasien + data poli
        $laporan = Antrian::with(['pasien', 'poli'])
                    ->whereDate('tanggal', $today)
                    ->orderBy('waktu_daftar', 'desc') // Urutkan dari yang terbaru
                    ->get();

        // 3. Kirim KEDUA variabel ($stats DAN $laporan) ke View
        return view('admin.laporan.index', compact('stats', 'laporan'));
    }
}
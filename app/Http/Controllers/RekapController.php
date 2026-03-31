<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Poli; // Pastikan memanggil model Poli
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        // 1. Ambil data rekapitulasi (untuk tabel)
        $rekap = Antrian::with(['pasien', 'poli'])
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('waktu_daftar', 'desc') 
                    ->get();

        // 2. Ambil data statistik (untuk progress bar/grafik)
        // Kita mengambil semua poli dan menghitung jumlah antreannya
        $stats = Poli::withCount('antrian')->get();

        // 3. Kirim kedua variabel ke view
        return view('admin.laporan.index', compact('rekap', 'stats'));
    }
}
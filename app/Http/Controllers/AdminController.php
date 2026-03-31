<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Poli; // Pastikan Model Poli di-import
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        
        // 1. Cek apakah ada filter Poli dari URL (misal: ?poli=1)
        $filterPoli = $request->query('poli'); 
        $namaPoliAktif = 'Semua Poli';

        // 2. Siapkan Query Dasar
        $currentQuery = Antrian::with('poli', 'pasien')
                        ->whereDate('tanggal', $today)
                        ->where('status', 'dipanggil');

        $waitingQuery = Antrian::with('poli', 'pasien')
                        ->whereDate('tanggal', $today)
                        ->where('status', 'menunggu')
                        ->orderBy('nomor_antrian', 'asc');

        $statsQuery   = Antrian::whereDate('tanggal', $today);

        // 3. Terapkan Filter jika ada
        if ($filterPoli) {
            $currentQuery->where('id_poli', $filterPoli);
            $waitingQuery->where('id_poli', $filterPoli);
            $statsQuery->where('id_poli', $filterPoli);
            
            // Ambil nama poli untuk judul dashboard
            $poliData = Poli::find($filterPoli);
            if($poliData) $namaPoliAktif = $poliData->nama_poli;
        }

        // 4. Eksekusi Query
        $current = $currentQuery->first();
        $waiting = $waitingQuery->get();
        
        // Statistik (Clone query agar tidak merusak query asli)
        $total   = (clone $statsQuery)->count();
        $sisa    = (clone $statsQuery)->where('status', 'menunggu')->count();
        $selesai = (clone $statsQuery)->where('status', 'selesai')->count();

        // Kirim semua data ke View
        return view('admin.dashboard', compact(
            'current', 'waiting', 'total', 'sisa', 'selesai', 
            'namaPoliAktif', 'filterPoli'
        ));
    }

    public function panggil($id)
    {
        // Sebelum panggil baru, selesaikan dulu yang sedang dipanggil (di poli yang sama/semua)
        // Opsional: Bisa diperketat hanya menyelesaikan antrian di poli yang sama
        $antrianBaru = Antrian::findOrFail($id);
        
        // Update antrian lama di poli yang sama menjadi selesai
        Antrian::where('status', 'dipanggil')
                ->where('id_poli', $antrianBaru->id_poli) 
                ->whereDate('tanggal', Carbon::today())
                ->update(['status' => 'selesai']);

        // Set pasien baru jadi 'dipanggil'
        $antrianBaru->update(['status' => 'dipanggil', 'waktu_panggil' => now()]);

        return redirect()->back()->with('success', 'Memanggil nomor ' . $antrianBaru->nomor_antrian);
    }

    public function selesai($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'selesai']);
        return redirect()->back()->with('success', 'Antrian selesai.');
    }

    public function lewati($id)
    {
        $antrian = Antrian::findOrFail($id);
        // Status 'batal' atau buat status khusus 'skipped'
        $antrian->update(['status' => 'batal']); 
        return redirect()->back()->with('success', 'Antrian dilewati (Batal).');
    }
}
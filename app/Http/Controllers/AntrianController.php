<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\Antrian;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Str; // Untuk icon di view

class AntrianController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('kiosk.index', compact('poli'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Lengkap
        // Jika gagal di sini, Laravel otomatis kembali ke View dengan $errors
        $request->validate([
            'nik' => 'required|numeric|digits_between:10,20',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'id_poli' => 'required|exists:poli,id_poli',
        ], [
            // Custom pesan error (opsional) agar lebih mudah dibaca pasien
            'nik.digits_between' => 'NIK harus antara 10 sampai 20 digit.',
            'nik.required' => 'NIK wajib diisi.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'id_poli.required' => 'Silakan pilih Poli tujuan.',
        ]);

        // 2. Update atau Buat Data Pasien
        $pasien = Pasien::updateOrCreate(
            ['nik' => $request->nik], // Kunci pencarian
            [
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]
        );

        // 3. Hitung Nomor Antrian Baru (Reset tiap hari)
        $lastAntrian = Antrian::where('id_poli', $request->id_poli)
                            ->whereDate('tanggal', Carbon::today())
                            ->orderBy('nomor_antrian', 'desc')
                            ->first();

        $nomorBaru = ($lastAntrian) ? $lastAntrian->nomor_antrian + 1 : 1;

        // 4. Simpan ke Tabel Antrian
        Antrian::create([
            'id_pasien' => $pasien->id_pasien,
            'id_poli' => $request->id_poli,
            'tanggal' => Carbon::today(),
            'nomor_antrian' => $nomorBaru,
            'status' => 'menunggu',
            'waktu_daftar' => now(),
        ]);

        // Ambil nama poli untuk ditampilkan di struk
        $namaPoli = Poli::find($request->id_poli)->nama_poli;
        
        // 5. Kembali ke Halaman dengan Data Struk
        return redirect()->route('antrian.index')->with([
            'success' => true,
            'nomor' => $nomorBaru,
            'poli' => $namaPoli,
            'nama_pasien' => $pasien->nama,
            'nik' => $pasien->nik
        ]);
    }
}
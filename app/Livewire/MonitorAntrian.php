<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
use App\Models\Poli;
use Carbon\Carbon;

class MonitorAntrian extends Component
{
    // Properti untuk filter poli (bisa dipilih lewat dropdown)
    public $poli_id = ''; 

    // Ambil parameter dari URL jika ada (contoh: /monitor?poli=1)
    public function mount()
    {
        $this->poli_id = request()->query('poli', '');
    }

    public function render()
    {
        $today = Carbon::today();

        // 1. Query Antrian Sedang Dipanggil
        $currentQuery = Antrian::with('poli', 'pasien')
                        ->whereDate('tanggal', $today)
                        ->where('status', 'dipanggil');

        // 2. Query Daftar Tunggu
        $nextQuery = Antrian::with('poli', 'pasien')
                     ->whereDate('tanggal', $today)
                     ->where('status', 'menunggu')
                     ->orderBy('nomor_antrian', 'asc');

        // Terapkan Filter jika poli dipilih
        if ($this->poli_id) {
            $currentQuery->where('id_poli', $this->poli_id);
            $nextQuery->where('id_poli', $this->poli_id);
        }

        $current = $currentQuery->first();
        $next = $nextQuery->take(5)->get(); // Ambil 5 antrian berikutnya
        $polis = Poli::all(); // Data untuk dropdown menu

        return view('livewire.monitor-antrian', [
            'current' => $current,
            'next' => $next,
            'polis' => $polis
        ])->layout('components.layouts.app'); // Pastikan pakai layout yang sudah kita buat
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';
    public $timestamps = false; // Kita pakai kolom 'waktu_daftar' manual

    protected $fillable = [
        'id_pasien', 
        'id_poli', 
        'tanggal', 
        'nomor_antrian', 
        'status',       // Enum: menunggu, dipanggil, selesai, batal
        'waktu_daftar', 
        'waktu_panggil'
    ];

    // Agar kolom tanggal otomatis dianggap sebagai objek Tanggal (Carbon) oleh Laravel
    protected $casts = [
        'tanggal' => 'date',
        'waktu_daftar' => 'datetime',
        'waktu_panggil' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }
}
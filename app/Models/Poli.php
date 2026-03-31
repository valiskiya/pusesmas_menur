<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    // Konfigurasi Tabel
    protected $table = 'poli';
    protected $primaryKey = 'id_poli';
    public $timestamps = false; // Tabel ini tidak punya created_at/updated_at

    protected $fillable = [
        'nama_poli', 
        'estimasi_menit'
    ];

    // Relasi: Satu Poli punya banyak Dokter
    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli', 'id_poli');
    }

    // Relasi: Satu Poli punya banyak Antrian
    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'id_poli', 'id_poli');
    }
}
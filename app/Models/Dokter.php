<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'nama_dokter', 
        'no_izin_praktek', // <-- TAMBAHAN BARU
        'id_poli'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalDokter::class, 'id_dokter', 'id_dokter');
    }
}
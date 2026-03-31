<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    
    // Karena di database kamu cuma ada 'created_at' dan TIDAK ADA 'updated_at',
    // Kita matikan auto timestamp Laravel agar tidak error saat update data.
    public $timestamps = false; 

    protected $fillable = [
        'nik', 
        'nama', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'no_hp',
        'created_at' // Kita masukkan ini agar bisa diisi manual jika perlu
    ];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'id_pasien', 'id_pasien');
    }
}
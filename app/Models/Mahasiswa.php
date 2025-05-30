<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dosen;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // NIM tidak auto increment
    protected $keyType = 'string'; // karena NIM biasanya berupa string
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'angkatan',
        'nama',
        'password',
        'prodi',
        'dosen_nip',
        'level',
        'prestasi_tertinggi', // tambahkan ini
        'poin_presma',        // dan ini
    ];

    // Relasi dengan tabel Level
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }

    public function dosen()
{
    return $this->belongsTo(Dosen::class, 'dosen_nip', 'nip');
}
    // Jika mahasiswa memiliki banyak prestasi, bisa tambahkan relasi seperti ini:
    // public function prestasis()
    // {
    //     return $this->hasMany(Prestasi::class, 'nim', 'nim');
    // }
}

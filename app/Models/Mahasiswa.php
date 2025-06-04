<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dosen;
use App\Models\Jenis;

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
        'prestasi_tertinggi',
        'poin_presma',
    ];

    // Relasi ke tabel level
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }

    // Relasi ke dosen pembimbing
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_nip', 'nip');
    }

    // 🔹 Relasi ke jenis lomba melalui keahlian
    public function keahlian()
    {
        return $this->belongsToMany(Jenis::class, 'keahlian_mahasiswa', 'nim', 'id_jenis');
    }
}

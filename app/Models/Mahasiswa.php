<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // Karena PK bukan auto increment
    protected $keyType = 'string'; // Karena nim adalah string
    public $timestamps = true; // Sesuai migrasi (timestamps ada)

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
        'email',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_nip', 'nip');
    }

    public function keahlian()
    {
        return $this->belongsToMany(Jenis::class, 'keahlian_mahasiswa', 'nim', 'id_jenis')
                    ->withTimestamps();
    }

    public function getPreferredJenisAttribute()
    {
        return $this->keahlian()->first();
    }

    public function getPreferredJenisIdsAttribute()
    {
        return $this->keahlian->pluck('id_jenis')->toArray();
    }
}


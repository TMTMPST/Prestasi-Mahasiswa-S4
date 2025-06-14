<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $guard = 'dosen';

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false;

    protected $fillable = [
        'nip', 'nama', 'email', 'password', 'level', 'bidangMinat',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi dengan tabel Level
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }

    // Relasi dengan tabel Mahasiswa
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_nip', 'nip');
    }

    public function bidangMinatJenis()
{
    return $this->belongsTo(Jenis::class, 'bidangMinat', 'id_jenis');
}
}

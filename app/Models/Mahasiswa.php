<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // NIM tidak auto increment
    protected $fillable = [
        'nim',
        'angkatan',
        'nama',
        'password',
        'prodi',
        'level',
    ];

    // Relasi dengan tabel Level
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }
}

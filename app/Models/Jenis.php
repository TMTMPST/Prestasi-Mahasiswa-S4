<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    protected $fillable = ['id_jenis', 'nama_jenis'];

    // Relasi ke mahasiswa melalui tabel pivot
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'keahlian_mahasiswa', 'id_jenis', 'nim');
    }
}

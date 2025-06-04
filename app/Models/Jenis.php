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
    public $incrementing = false; // Karena primary key bukan auto increment, jika memang bukan integer autoincrement
    protected $keyType = 'int';    // Sesuaikan tipe primary key, misal int

    protected $fillable = ['id_jenis', 'nama_jenis'];

    // Relasi many-to-many ke mahasiswa lewat tabel pivot 'keahlian_mahasiswa'
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'keahlian_mahasiswa', 'id_jenis', 'nim');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLomba extends Model
{
    use HasFactory;

    protected $table = 'data_lomba';
    protected $primaryKey = 'id_lomba';
    public $incrementing = true;
    protected $fillable = ['nama_lomba', 'tgl_dibuka', 'tgl_ditutup', 'tingkat', 'kategori', 'jenis', 'penyelenggara', 'alamat'];

    // Relasi dengan tabel Tingkat
    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id_tingkat');
    }

    // Relasi dengan tabel Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }

    // Relasi dengan tabel Jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis', 'id_jenis');
    }
}

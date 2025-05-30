<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tingkat;
use App\Models\Kategori;
use App\Models\Jenis;

class DataLomba extends Model
{
    use HasFactory;

    protected $table = 'data_lomba';
    protected $primaryKey = 'id_lomba';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
    'nama_lomba',
    'tingkat_id',
    'kategori_id',
    'jenis_id',
    'penyelenggara',
    'tanggal_mulai',
    'tanggal_selesai'
];


    public function tingkatRelasi()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id_tingkat');
    }

    public function kategoriRelasi()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'id_kategori');
    }

    public function jenisRelasi()
    {
        return $this->belongsTo(Jenis::class, 'jenis', 'id_jenis');
    }
}

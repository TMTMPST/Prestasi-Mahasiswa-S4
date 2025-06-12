<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tingkat;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\alternatif;
use App\Models\Kriteria;
class DataLomba extends Model
{
    use HasFactory;

    protected $table = 'data_lomba';
    protected $primaryKey = 'id_lomba';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
    'nama_lomba',
    'tingkat',
    'jenis',
    'tingkat_penyelenggara',
    'penyelenggara',
    'alamat',
    'link_lomba',
    'biaya',
    'hadiah',
    'tgl_dibuka',
    'tgl_ditutup',
    'verifikasi',
];


    public function tingkatRelasi()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id_tingkat');
    }

    public function jenisRelasi()
    {
        return $this->belongsTo(Jenis::class, 'jenis', 'id_jenis');
    }

    public function nilaiKriteria()
    {
        return $this->hasMany(alternatif::class, 'id_lomba', 'id_lomba');
    }
}

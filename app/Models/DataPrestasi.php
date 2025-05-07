<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrestasi extends Model
{
    use HasFactory;

    protected $table = 'data_prestasi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['peringkat', 'id_lomba', 'sertif', 'foto_bukti', 'verifikasi', 'poster_lomba'];

    // Relasi dengan tabel DataLomba
    public function dataLomba()
    {
        return $this->belongsTo(DataLomba::class, 'id_lomba', 'id_lomba');
    }
}

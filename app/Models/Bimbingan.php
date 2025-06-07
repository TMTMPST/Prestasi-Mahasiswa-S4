<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $table = 'bimbingan';
    protected $primaryKey = 'id_bimbingan';
    public $incrementing = true;
    protected $fillable = [
        'id_lomba',
        'nama_pengaju',
        'nip',
        'nim',
        'deskripsi_lomba',
        'status',
    ];


    public function lomba()
    {
        return $this->belongsTo(DataLomba::class, 'id_lomba', 'id_lomba');
    }


    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }
}

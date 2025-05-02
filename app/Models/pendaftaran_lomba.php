<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaranLomba extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_lomba';
    protected $fillable = ['mahasiswa_id', 'kompetisi_id', 'tanggal_daftar', 'status'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kompetisi() {
        return $this->belongsTo(Kompetisi::class);
    }
}


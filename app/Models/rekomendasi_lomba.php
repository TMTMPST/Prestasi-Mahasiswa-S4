<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiLomba extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_lomba';
    protected $fillable = ['mahasiswa_id', 'kompetisi_id', 'skor_kecocokan', 'alasan'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kompetisi() {
        return $this->belongsTo(Kompetisi::class);
    }
}


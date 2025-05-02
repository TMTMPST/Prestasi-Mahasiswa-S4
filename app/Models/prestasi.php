<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = ['mahasiswa_id', 'kategori', 'nama_prestasi', 'tingkat', 'penyelenggara', 'tahun', 'bukti_file', 'status_verifikasi', 'catatan_admin'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}


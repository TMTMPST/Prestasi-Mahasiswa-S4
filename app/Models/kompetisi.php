<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kompetisi extends Model
{
    use HasFactory;
    protected $table = 'kompetisi';
    protected $fillable = ['nama', 'kategori', 'bidang_keahlian', 'penyelenggara', 'tingkat', 'tanggal_mulai', 'tanggal_akhir', 'link_pendaftaran', 'status_verifikasi'];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = ['user_id', 'nama', 'nim', 'prodi_id', 'angkatan', 'minat', 'keahlian'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function programStudi() {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }
}



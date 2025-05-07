<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false; // NIP tidak auto increment
    protected $fillable = [
        'nip',
        'nama',
        'password',
        'level',
    ];

    // Relasi dengan tabel Level
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }
}

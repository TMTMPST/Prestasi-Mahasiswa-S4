<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $fillable = ['user_id', 'nama', 'nidn', 'bidang_minat'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;

    protected $table = 'tingkat';
    protected $primaryKey = 'id_tingkat';
    protected $fillable = ['id_tingkat', 'nama_tingkat'];
}

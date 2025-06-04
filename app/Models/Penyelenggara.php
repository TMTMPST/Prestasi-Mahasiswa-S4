<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    use HasFactory;

    protected $table = 'penyelenggara'; // Specify table name if it's not the plural form of the model name

    protected $fillable = [
        'nama',
        'jenis_penyelenggara',
    ];
}
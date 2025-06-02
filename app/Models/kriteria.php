<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\alternatif;

class kriteria extends Model
{
    protected $table = 'kriteria';

    public function nilai()
    {
        return $this->hasMany(alternatif::class, 'id_kriteria', 'id');
    }
}


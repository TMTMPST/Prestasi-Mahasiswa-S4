<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataLomba;
use App\Models\kriteria;

class alternatif extends Model
{
    protected $table = 'nilai_kriteria';

    public function lomba()
    {
        return $this->belongsTo(DataLomba::class, 'id_lomba', 'id_lomba');
    }

    public function kriteria()
    {
        return $this->belongsTo(kriteria::class, 'id_kriteria', 'id');
    }
}

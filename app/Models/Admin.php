<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'nip';
    public $incrementing = false; // NIP tidak auto increment
    protected $fillable = [
        'nip',
        'nama',
        'password',
        'level',
    ];
    protected $hidden = [
        'password',
    ];
    public function level()
    {
        return $this->belongsTo(Level::class, 'level', 'id_level');
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
}

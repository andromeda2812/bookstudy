<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruang'; // sesuai tabel migration

    protected $fillable = [
        'nama',
        'kapasitas',
        'deskripsi',
        'foto',
        'status',
        'status_user',
    ];
    
}

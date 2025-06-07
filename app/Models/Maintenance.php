<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'ruang_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan',
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}

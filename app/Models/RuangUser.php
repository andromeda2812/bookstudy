<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangUser extends Model
{
    protected $table = 'ruang';  // pastikan tetap pakai tabel 'ruang'

    protected $fillable = [
        'nama',
        'kapasitas',
        'deskripsi',
        'foto',
        'status',
    ];

    // Accessor untuk menampilkan status sebagai teks
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Tersedia' : 'Tidak Tersedia';
    }

    // Scope untuk ruang yang tersedia
    public function scopeAvailable($query)
    {
        return $query->where('status', true);
    }

    // Scope untuk ruang yang tidak tersedia
    public function scopeUnavailable($query)
    {
        return $query->where('status', false);
    }
}

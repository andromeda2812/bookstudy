<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'ruang_id',
        'upload_ktm',
        'tanggal_booking',
        'waktu_mulai',
        'waktu_selesai',
        'tujuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

}


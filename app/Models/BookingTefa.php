<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTefa extends Model
{
    protected $table = 'booking_tefa';

    protected $primaryKey = 'id_book';

    protected $fillable = [
        'id_transaksi',
        'status_book',
        'keterangan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(
            TransaksiTefa::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function tambahan()
    {
        return $this->hasMany(
            TambahanTefa::class,
            'id_book',
            'id_book'
        );
    }
}
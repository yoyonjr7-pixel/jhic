<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TambahanTefa extends Model
{
    protected $table = 'tambahan_tefa';

    protected $primaryKey = 'id_tambahan';

    protected $fillable = [
        'id_book',
        'nama_tambahan',
        'keterangan',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(
            BookingTefa::class,
            'id_book',
            'id_book'
        );
    }
}
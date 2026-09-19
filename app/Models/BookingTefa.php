<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTefa extends Model
{
    protected $table = 'booking_tefa';

    protected $primaryKey = 'id_book';

    protected $guarded = [];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(TransaksiTefa::class, 'id_transaksi', 'id_transaksi');
    }
}

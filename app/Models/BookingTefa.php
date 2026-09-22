<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTefa extends Model
{
    protected $table = 'booking_tefa';

    protected $primaryKey = 'id_book';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (BookingTefa $booking) {
            if (empty($booking->id_book)) {
                $booking->id_book = static::generateIdBook();
            }
        });
    }

    /**
     * Membuat nomor booking acak 6 digit yang belum dipakai.
     */
    protected static function generateIdBook(): int
    {
        do {
            $id = random_int(100000, 999999);
        } while (static::where('id_book', $id)->exists());

        return $id;
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(TransaksiTefa::class, 'id_transaksi', 'id_transaksi');
    }
}

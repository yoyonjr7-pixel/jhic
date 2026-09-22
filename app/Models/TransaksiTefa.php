<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransaksiTefa extends Model
{
    protected $table = 'transaksi_tefa';

    protected $primaryKey = 'id_transaksi';

    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function booking(): HasOne
    {
        return $this->hasOne(BookingTefa::class, 'id_transaksi', 'id_transaksi');
    }
}

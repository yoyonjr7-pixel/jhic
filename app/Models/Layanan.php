<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $primaryKey = 'id_layanan';

    protected $guarded = [];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiTefa::class, 'id_layanan', 'id_layanan');
    }
}

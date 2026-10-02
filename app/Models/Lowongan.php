<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lowongan extends Model
{
    protected $table = 'lowongan_kerja';

    protected $primaryKey = 'id_lowongan';

    protected $guarded = [];

    /**
     * Kolom `skills` disimpan sebagai JSON, di-cast ke array agar
     * dapat di-loop pada halaman Jurusan & Karir.
     */
    protected $casts = [
        'skills' => 'array',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}

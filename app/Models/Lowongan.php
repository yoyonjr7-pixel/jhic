<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

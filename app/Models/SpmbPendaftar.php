<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPendaftar extends Model
{
    protected $table = 'spmb';

    protected $primaryKey = 'id_spmb';

    protected $fillable = [
        'nama',
        'email',
        'whatsapp_siswa',
        'whatsapp_orang_tua',
        'alamat',
        'asal_sekolah',
        'agama',
        'jurusan',
        'sumber_informasi',
        'status',
    ];
}

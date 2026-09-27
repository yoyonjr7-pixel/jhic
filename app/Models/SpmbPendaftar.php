<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPendaftar extends Model
{
    protected $table = 'spmb_pendaftar';

    protected $fillable = [
        'email',
        'nama_lengkap',
        'whatsapp_siswa',
        'whatsapp_orang_tua',
        'alamat',
        'asal_sekolah',
        'agama',
        'jurusan',
        'sumber_informasi',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'nama_layanan',
        'id_jurusan',
        'harga',
        'deskripsi',
    ];

    public function transaksiTefa()
    {
        return $this->hasMany(
            TransaksiTefa::class,
            'id_layanan',
            'id_layanan'
        );
    }

    public function jurusan()
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan',
            'id_jurusan'
        );
    }
}
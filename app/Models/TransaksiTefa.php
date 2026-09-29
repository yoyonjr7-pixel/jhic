<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTefa extends Model
{
    protected $table = 'transaksi_tefa';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'nama_pelanggan',
        'tanggal',
        'no_telp',
        'deskripsi',
        'id_layanan',
        'id_guru',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function booking()
    {
        return $this->hasOne(
            BookingTefa::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function layanan()
    {
        return $this->belongsTo(
            Layanan::class,
            'id_layanan',
            'id_layanan'
        );
    }

    public function guru()
    {
        return $this->belongsTo(
            Guru::class,
            'id_guru',
            'id_guru'
        );
    }
}
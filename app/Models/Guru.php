<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama_guru',
        'id_jurusan',
    ];

    public function transaksiTefa()
    {
        return $this->hasMany(
            TransaksiTefa::class,
            'id_guru',
            'id_guru'
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
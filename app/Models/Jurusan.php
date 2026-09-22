<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $primaryKey = 'id_jurusan';

    protected $guarded = [];

    public function layanan(): HasMany
    {
        return $this->hasMany(Layanan::class, 'id_jurusan', 'id_jurusan');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_jurusan', 'id_jurusan');
    }

    public function guru(): HasMany
    {
        return $this->hasMany(Guru::class, 'id_jurusan', 'id_jurusan');
    }
}

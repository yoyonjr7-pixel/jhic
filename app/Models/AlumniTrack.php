<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniTrack extends Model
{
    protected $table = 'alumni_track';

    protected $primaryKey = 'id_alumni';

    protected $fillable = [
        'id_siswa',
        'tahun_lulus',
        'no_telp',
        'email',
        'status',
        'keterangan',
        'mentor',
        'id_jurusan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}
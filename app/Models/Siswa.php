<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    public $timestamps = false;

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'kelas',
        'id_jurusan',
        'status',
    ];

    public function alumniTrack()
    {
        return $this->hasMany(AlumniTrack::class, 'id_siswa', 'id_siswa');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $primaryKey = 'id_jurusan';

    public function alumniTrack()
    {
        return $this->hasMany(AlumniTrack::class, 'id_jurusan', 'id_jurusan');
    }
}
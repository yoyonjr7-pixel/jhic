<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan_kerja';

    protected $primaryKey = 'id_lowongan';

    protected $guarded = [];
}

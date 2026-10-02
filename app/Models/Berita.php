<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Admin
    protected $table = 'berita';

    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'penulis',
        'isi',
        'foto',
        'tanggal_publish',
        'status',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}

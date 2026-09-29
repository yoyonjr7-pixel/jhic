<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $primaryKey = 'id_prestasi';

    protected $fillable = [
        'judul_prestasi',
        'nama_pemenang',
        'kelas',
        'id_jurusan',
        'tingkat',
        'juara',
        'tahun',
        'foto',
        'deskripsi',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(
            Jurusan::class,
            'id_jurusan',
            'id_jurusan'
        );
    }

    public function fotoUrl(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        if (str_starts_with($this->foto, 'prestasiimages/')) {
            return asset($this->foto);
        }

        return asset('storage/' . ltrim($this->foto, '/'));
    }
}
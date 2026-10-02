<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AlumniTrack extends Model
{
    protected $table = 'alumni_track';
    protected $primaryKey = 'id_alumni';
    protected $guarded = [];

    protected $casts = [
        'mentor' => 'boolean',
    ];

    public function statusLabel(): string
    {
        return [
            'bekerja' => 'Bekerja',
            'kuliah' => 'Melanjutkan Kuliah',
            'wirausaha' => 'Wirausaha',
            'mencari_kerja' => 'Masih Mencari Kerja',
        ][$this->status] ?? 'Status belum tersedia';
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function bookJasah(): HasOne
    {
        return $this->hasOne(BookJasah::class, 'id_alumni', 'id_alumni');
    }
}

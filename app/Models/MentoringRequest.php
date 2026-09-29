<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentoringRequest extends Model
{
    protected $table = 'mentoring_requests';

    protected $primaryKey = 'id_mentoring';

    protected $fillable = [
        'id_mentor',
        'mentor_nama',
        'nama_pemohon',
        'no_telp',
        'status_pemohon',
        'topik',
        'status_pengajuan',
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(AlumniTrack::class, 'id_mentor', 'id_alumni');
    }
}

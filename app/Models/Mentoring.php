<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Mentoring extends Model
{
    protected $table = 'mentoring'; protected $guarded = []; protected $casts = ['tanggal' => 'date'];
    public function siswa(): BelongsTo { return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa'); }
    public function jurusan(): BelongsTo { return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan'); }
    public function alumni(): BelongsTo { return $this->belongsTo(AlumniTrack::class, 'id_alumni', 'id_alumni'); }
}
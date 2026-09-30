<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookJasah extends Model
{
    protected $table = 'book_jasah';
    protected $primaryKey = 'id_bookjasah';
    public $incrementing = false;
    protected $guarded = [];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(AlumniTrack::class, 'id_alumni', 'id_alumni');
    }
}

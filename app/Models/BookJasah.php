<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookJasah extends Model
{
    protected $table = 'book_jasah';
    protected $primaryKey = 'id_bookjasah';
    public $incrementing = false;
    protected $guarded = [];
}

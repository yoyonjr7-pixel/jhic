<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnduhInformasi extends Model
{
    protected $table = 'unduh_informasi';

    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'deskripsi',
        'nama_file',
        'file_path',
        'format_file',
        'ukuran_file',
        'status',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'ukuran_file' => 'integer',
    ];
}
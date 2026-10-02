<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Admin
    protected $table = 'berita';

    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul_berita',
        'foto',
        'kategori',
        'Tanggal',
        'jam',
    ];

    protected $casts = [
        'Tanggal' => 'date',
    ];

    /**
     * URL publik untuk foto berita.
     * - Path lama "beritaimages/..." disajikan langsung dari public/.
     * - Hasil upload admin disimpan di disk public (storage/app/public/berita).
     */
    public function fotoUrl(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        if (str_starts_with($this->foto, 'beritaimages/')) {
            return asset($this->foto);
        }

        return asset('storage/' . ltrim($this->foto, '/'));
    }

    /**
     * Ringkasan tanggal + jam untuk tampilan, mis. "July 2, 2025 • 8:00 am".
     */
    protected function tanggalJam(): Attribute
    {
        return Attribute::get(function (): string {
            $tanggal = $this->Tanggal?->format('F j, Y') ?? '';

            if (! $this->jam) {
                return $tanggal;
            }

            try {
                $jam = \Carbon\Carbon::parse($this->jam)->format('g:i a');
            } catch (\Throwable) {
                $jam = $this->jam;
            }

            return $tanggal !== '' ? $tanggal . ' • ' . $jam : $jam;
        });
    }
}

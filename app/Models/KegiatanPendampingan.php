<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanPendampingan extends Model
{
    protected $table = 'kegiatan_pendampingan';

    protected $fillable = [
        'judul',
        'tanggal',
        'ringkasan',
        'narasi',
        'gambar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}

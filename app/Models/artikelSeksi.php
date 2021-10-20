<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class artikelSeksi extends Model
{
    protected $table = 'artikel_seksis';
    protected  $fillable = ['sidang_id',
    'nomor_artikel',
    'nomor_artikel_seksi',
    'seksi_id',
    'peserta_id',
    'judul',
    'setelah_sidang_bahas',
    'Mengingat',
    'Mempertimbangkan',
    'Memutuskan',
    'lampiran',
    'verified',
    ];

    use HasFactory;

    public function Sidang()
    {
        return $this->hasMany(Sidang::class);
    }
}

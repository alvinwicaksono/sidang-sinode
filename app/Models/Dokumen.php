<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = "tdokumen";
    protected $fillable = [
        'jumdok',
        'batas_akses',
        'nama_dokumen',
        'keterangan',
        'tanggal_buat',
        'pengarang',
        'kode_dokumen',
        'tanggal_masuk',
        'lembaga_id',
        'box_id',
        'subbidang_id',
        'format_id',
        'file'
        ];
    use HasFactory;

    public function Lembaga(){
        return $this->belongsTo(Lembaga::class);
    }
    public function Box(){
        return $this->belongsTo(Box::class);
    }
    public function Format(){
        return $this->belongsTo(Format::class);
    }
    public function SubBidang(){
        return $this->belongsTo(SubBidang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_b extends Model
{
    use HasFactory;
    protected $fillable = [
        'sidang_id', 'repoa_id', 'seksi_id', 'judul_materi', 'isi_materi', 'attachment', 'status'
    ];

    public function Sidang(){
        return $this->belongsTo(Sidang::class);
    }

    public function Repo_a(){
        return $this->belongsTo(Repo_a::class);
    }

    public function Seksi(){
        return $this->belongsTo(Seksi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_a extends Model
{
    use HasFactory;
    protected $fillable = [
        'sidang_id', 'judul_materi', 'isi_materi', 'sumber_materi', 'attachment', 'status', 'count'
    ];

    public function Sidang(){
        return $this->belongsTo(Sidang::class);
    }

    public function Repo_b(){
        return $this->hasMany(Repo_b::class);
    }
}

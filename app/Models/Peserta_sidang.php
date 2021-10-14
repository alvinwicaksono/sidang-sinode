<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta_sidang extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'nama_pengguna', 'sidang_id', 'utusan'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Sidang(){
        return $this->belongsTo(Sidang::class);
    }
}
